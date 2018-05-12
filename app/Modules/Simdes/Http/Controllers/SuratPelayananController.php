<?php

namespace App\Modules\Simdes\Http\Controllers;

use PDF;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Modules\Core\Helpers\DateUtil;
use App\Modules\Simdes\Models\IdentitasDesa;
use App\Modules\Simdes\Models\SuratPelayanan;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\SuratPelayananRequest;

class SuratPelayananController extends AuthController
{
    protected $table;

    public function __construct()
    {
        $this->table = new SuratPelayanan();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->type)) {
            return $this->getAll($request, SuratPelayanan::class, ['keperluanSurat']);
        } else {
            $data = SuratPelayanan::whereHas('keperluanSurat', function ($q) use ($request) {
                $q->where('tipe', '=', $request->type);
            })->orderBy('id', 'DESC');

            $perPage = empty($request->perPage) ? 20 : $request->perPage;
            $all = empty($request->all) ? false : true;

            if (!empty($request->q)) {
                $field = empty($request->field) ? 'nama' : $request->field;
                $data->where($field, 'like', '%'.$request->q.'%');
            }

            $data = $all ? $data->limit(200)->get() : $data->paginate($perPage);

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratPelayananRequest $request)
    {
        /**
         * TODO : improve this query
         * @author Yuana
         */
        $data = $request->all();
        $surat = $this->table->orderBy('id', 'desc')->first();
        $lastMonth = $surat ? $surat->created_at->format('m') : 0;
        $data['no'] = $this->table->whereMonth('created_at', $lastMonth)->count() + 1;
        $store = $this->table->create($data);

        return $this->jsonResponseSuccess([
            'data' => $store
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->table->findOrFail($id);

        return $this->jsonResponseSuccess([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratPelayananRequest $request, $id)
    {
        $data = $this->table->findOrFail($id);
        $data->fill($request->all())->save();
        return $this->jsonResponseSuccess([
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = $this->table->findOrFail($id);
        $delete = $data->delete();

        if ($delete) {
            return $this->jsonResponseSuccess([
                'data' => ""
            ]);
        }
    }

    public function render(Request $request, $id)
    {
        //TODO validasi jika blm punya desa
        $surat = $this->table->findOrFail($id);
        $desa = $surat->village->toArray()['village_identity']; // TODO @andhikayuana mengko iki dicek meneh

        if (is_null($desa)) {
            $desa = [
                'kepala_desa' => '-',
                'alamat_kelurahan' => '-',
                'logo' => ''
            ];
            // return $this->jsonResponse([
            //     'code' => 404,
            //     'message' => 'Village idenity not found',
            // ], 404);
        }

        $data = [
            'surat_jenis' => $surat->jenis,
            'pemegang' => $surat->nama,
            'nik' => $surat->nik,
            'tempat_lahir' => $surat->tempat_lahir,
            'tanggal_lahir' => DateUtil::getInstance()->createFromFormat($surat->tanggal_lahir, 'Y-m-d', 'j F Y'),
            'warganegara' => $surat->kewarganegaraan,
            'agama' => $surat->religion->name,
            'pekerjaan' => $surat->job->name,
            'alamat_pemegang' => $surat->alamat . ' RT: '. $surat->rt . ' RW: '.$surat->rw,
            'berlaku' => DateUtil::getInstance()->createFromFormat($surat->tgl_berlaku_dari, 'Y-m-d', 'j F Y').
                ' s/d '. DateUtil::getInstance()->createFromFormat($surat->tgl_berlaku_sampai, 'Y-m-d', 'j F Y'),
            'keterangan' => $surat->keterangan,
            'kepala_desa' => !empty($desa['kepala_desa']) ? $desa['kepala_desa'] : "-",
            'kabupaten' => $surat->village->subdistrict->regency->name,
            'kecamatan' => $surat->village->subdistrict->name,
            'desa' => $surat->village->name,
            'dibuatpada' => $surat->created_at->format('j F Y'),
            'nomor_surat' => $surat->getNoSurat(),
            'alamat_kelurahan' => !empty($desa['alamat']) ? $desa['alamat'] : "-",
            'logo' => $desa['logo'],
        ];
        //TODO : logo render slowly ??

        // \Illuminate\Support\Facades\Log::debug($data);
        // \Illuminate\Support\Facades\Log::debug($surat);

        $pdf = PDF::loadView('simdes::surat-pelayanan', $data)->setPaper('a4');

        return $pdf->stream();
        // return 'hai';
    }
}
