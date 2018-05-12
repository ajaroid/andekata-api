<?php

namespace App\Modules\Simdes\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Simdes\Models\Job;
use App\Modules\Simdes\Http\Requests\JobRequest;
use App\Modules\Core\Http\Controllers\AuthController;

class JobController extends AuthController
{
    public function index(Request $request)
    {
        return $this->getAll($request, Job::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Job::class);
    }


    public function store(JobRequest $request)
    {
        return $this->create($request->all(), Job::class);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function update(JobRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Job::class);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Job::class);
    }
}
