<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Dept;
use App\Modules\Core\Helpers\NumberingUtil;
use App\Modules\Core\Http\Requests\DeptRequest;

class DeptController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Dept::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\DeptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeptRequest $request)
    {
        $code = NumberingUtil::getInstance()->generateCode('DPT');
        $request['code'] = $code;
        return $this->create($request->all(), Dept::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Dept::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\DeptRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeptRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Dept::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Dept::class);
    }
}
