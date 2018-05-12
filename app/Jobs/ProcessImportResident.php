<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use App\Modules\Core\Helpers\Converter;
use Illuminate\Support\Facades\Storage;
use App\Modules\Simdes\Models\Resident;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessImportResident implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tmpPath;
    protected $villageId;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $villageId, String $tmpPath, String $type = 'csv')
    {
        $this->villageId= $villageId;
        $this->tmpPath = $tmpPath;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function () {

            $uploadedFile = Storage::disk('local')
                            ->getDriver()
                            ->getAdapter()
                            ->applyPathPrefix($this->tmpPath);

            if ($this->type == 'csv') {
                $this->handleImportCsv($uploadedFile);
            } else {
                $this->handleImportXls($this->tmpPath);
            }
        });
    }

    private function handleImportCsv($uploadedFile)
    {
        $data = Converter::getInstance()->csvToArray($uploadedFile);
        
        $this->chunkInsert($data);
    }

    private function handleImportXls($uploadedFile)
    {
        // ->load() : from storage/app/...
        \Excel::load('storage/app/'.$uploadedFile, function($reader) {

            $results = $reader->all();

            $this->chunkInsert($results->toArray());
        });
    }
    
    private function chunkInsert($data)
    {
        $chunkResidents = collect($data)
                        ->map(function ($resident) {
                            return Resident::parseData($this->villageId, $resident);
                        })
                        ->chunk(1000)
                        ->toArray();
        
        foreach ($chunkResidents as $residents) {
            Resident::insertOnDuplicate($residents, 'nik');
        }

        // Storage::disk('local')->delete($this->tmpPath);
    }
}
