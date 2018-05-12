<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Models\Religion;
use App\Modules\Simdes\Http\Requests\ReligionRequest;
use App\Modules\Core\Http\Controllers\AuthController;

class ReligionController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Religion::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReligionRequest $request)
    {
        return $this->create($request->all(), Religion::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Religion::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReligionRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Religion::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Religion::class);
    }
}
