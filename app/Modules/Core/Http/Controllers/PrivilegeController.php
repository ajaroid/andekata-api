<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Privilege;
use App\Modules\Core\Http\Requests\PrivilegeRequest;

class PrivilegeController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Privilege::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\PrivilegeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivilegeRequest $request)
    {
        return $this->create($request->all(), Privilege::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Privilege::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\PrivilegeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrivilegeRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Privilege::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Privilege::class);
    }
}
