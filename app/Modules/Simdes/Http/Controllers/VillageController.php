<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Http\Requests\VillageRequest;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Models\Village;

class VillageController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Village::class, ['subdistrict.regency.provincy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillageRequest $request)
    {
        return $this->create($request->all(), Village::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Village::class, ['subdistrict.regency.provincy']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VillageRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Village::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Village::class);
    }
}


