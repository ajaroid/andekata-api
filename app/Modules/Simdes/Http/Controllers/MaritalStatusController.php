<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Models\MaritalStatus;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\MaritalStatusRequest;

class MaritalStatusController extends AuthController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, MaritalStatus::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaritalStatusRequest $request)
    {
        return $this->create($request->all(), MaritalStatus::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, MaritalStatus::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaritalStatusRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, MaritalStatus::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, MaritalStatus::class);
    }
}
