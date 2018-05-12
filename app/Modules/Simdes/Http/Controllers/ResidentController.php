<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Jobs\ProcessImportResident;
use App\Modules\Simdes\Models\Resident;
use Illuminate\Support\Facades\Storage;
use App\Modules\Simdes\Http\Requests\ResidentRequest;
use App\Modules\Core\Http\Controllers\AuthController;

class ResidentController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Resident::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResidentRequest $request)
    {
        return $this->create($request->all(), Resident::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Resident::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResidentRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Resident::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Resident::class);
    }

    /**
     * Import Resident from CSV
     */

     public function importCsv(Request $request)
     {
          return $this->handleImport($request, 'csv');
     }

     public function importExcel(Request $request)
     {
         return $this->handleImport($request, 'xls');
     }

     private function handleImport(Request $request, $type = 'csv')
     {
        try {

            $allowedMime = $type == 'csv' ? 'txt,csv,xls' : 'xls,xlsx';

            $request->validate([
                'village_id' => 'required|integer',
                'file' => 'required|mimes:'.$allowedMime.'|max:5120'
            ]);

            $villageId = $request->input('village_id');
            $file = $request->file('file');
            $tmp = $file->store('tmp', 'local');

            if (Storage::disk('local')->exists($tmp)) {

                ProcessImportResident::dispatch($villageId, $tmp, $type);

                return $this->jsonResponseSuccess([], "Importing Resident to Database...");

            } else {
                throw new \Exception('file not found or not uploaded', 404);
            }

          } catch (\Exception $e) {
              return $this->errorResponse($e);
          }
     }
}
