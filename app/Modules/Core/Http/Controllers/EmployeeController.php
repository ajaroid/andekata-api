<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Modules\Core\Models\Employee;
use Illuminate\Support\Facades\Storage;
use App\Modules\Core\Helpers\NumberingUtil;
use App\Modules\Core\Http\Requests\EmployeeRequest;

class EmployeeController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Employee::class, [
            'village.subdistrict.regency.provincy',
            'maritalStatus:id,name'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $code = NumberingUtil::getInstance()->generateCode('EMP');
        $request['code'] = $code;
        return $this->create($request->all(), Employee::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Employee::class, [
            'position.department',
            'village.subdistrict.regency.provincy',
            'maritalStatus:id,name'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\EmployeeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Employee::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Employee::class);
    }

    /**
     * Upload photo employee
     */
    public function uploadPhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif,bmp|max:512|dimensions:max_width=800,max_height=800'
            ]);

            $image = $request->file('photo');
            $upload = $image->store('employee/photo', 'public');

            return $this->jsonResponseSuccess([
                'data' => [
                    'url' => URL::to('/') . Storage::url($upload)
                ]
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
