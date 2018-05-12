<?php

namespace App\Modules\Simdes\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Simdes\Models\SuratNikah;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\SuratNikahRequest;

class SuratNikahController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, SuratNikah::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Simdes\Http\Requests\SuratNikahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratNikahRequest $request)
    {
        try {
            /**
             * TODO : improve this query
             * @author Yuana
             */
            $data = $request->all();
            $surat = SuratNikah::orderBy('id', 'desc')->first();
            $lastMonth = $surat ? $surat->created_at->format('m') : 0;
            $data['no'] = SuratNikah::whereMonth('created_at', $lastMonth)->count() + 1;

            return $this->create($data, SuratNikah::class);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, SuratNikah::class, [
            'village.subdistrict.regency.provincy',

            'pemohonMaritalStatus:id,name',
            'pemohonShk:id,name',
            'pemohonReligion:id,name',
            'pemohonEducation:id,name',
            'pemohonJob:id,name',
            'pemohonVillage.subdistrict.regency.provincy',

            'catinReligion:id,name',
            'catinEducation:id,name',
            'catinJob:id,name',
            'catinVillage.subdistrict.regency.provincy',

            'ayahReligion:id,name',
            'ayahEducation:id,name',
            'ayahJob:id,name',
            'ayahVillage.subdistrict.regency.provincy',

            'ibuReligion:id,name',
            'ibuEducation:id,name',
            'ibuJob:id,name',
            'ibuVillage.subdistrict.regency.provincy'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Simdes\Http\Requests\SuratNikahRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratNikahRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, SuratNikah::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, SuratNikah::class);
    }

    /**
     * Render Surat Nikah N1-N7
     *
     * @param Request $request
     * @param int $id
     */
    public function render(Request $request, $id)
    {

    }
}
