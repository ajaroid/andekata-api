<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Models\KK;
use App\Modules\Simdes\Models\KKDetail;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\KKRequest;

class KKController extends AuthController
{
    protected $table;

    public function __construct($value='')
    {
        $this->table = new KK;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, KK::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KKRequest $request)
    {
        $store = $this->table->create($request->all());
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
        $penduduk = KKDetail::where('kk_id', $id)->get();
        $data->kkdetail = $penduduk;

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
    public function update(KKRequest $request, $id)
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

        if($delete){
            return $this->jsonResponseSuccess([
                'data' => ""
            ]);
        }
    }
}
