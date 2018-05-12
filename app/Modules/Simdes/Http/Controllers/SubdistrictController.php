<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Http\Requests\SubdistrictRequest;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Models\Subdistrict;

class SubdistrictController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Subdistrict::orderBy('id', 'DESC');
        try {
            $perPage = empty($request->perPage) ? 20 : $request->perPage;
            $all = empty($request->all) ? false : true;

            if (!empty($request->q)) {
                $model->where('name', 'like', '%'.$request->q.'%');
            }
            if (!empty($request->regency_id)) {
                $model->where('regency_id', '=', $request->regency_id);
            }

            $model->with(['regency.provincy']);

            $data = $all ? $model->get() : $model->paginate($perPage);

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubdistrictRequest $request)
    {
        return $this->create($request->all(), Subdistrict::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Subdistrict::class, ['regency.provincy', 'villages']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubdistrictRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Subdistrict::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Subdistrict::class);
    }
}


