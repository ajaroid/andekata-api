<?php

namespace App\Modules\Simdes\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Simdes\Models\Education;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\EducationRequest;

class EducationController extends AuthController
{
    public function index(Request $request)
    {
        return $this->getAll($request, Education::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Education::class);
    }

    public function store(EducationRequest $request)
    {
        return $this->create($request->all(), Education::class);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function update(EducationRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Education::class);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Education::class);
    }
}
