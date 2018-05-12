<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Http\Requests\ProvincyRequest;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Models\Provincy;

class ProvincyController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Provincy::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvincyRequest $request)
    {
        return $this->create($request->all(), Provincy::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Provincy::class, ['regencies']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvincyRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Provincy::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Provincy::class);
    }
}

