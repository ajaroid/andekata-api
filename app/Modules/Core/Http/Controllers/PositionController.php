<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Position;
use App\Modules\Core\Http\Requests\PositionRequest;

class PositionController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Position::class, ['department']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\PositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        return $this->create($request->all(), Position::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Position::class, ['department']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\PositionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Position::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Position::class);
    }
}
