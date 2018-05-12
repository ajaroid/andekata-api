<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Simdes\Models\Regency;
use App\Modules\Simdes\Http\Requests\RegencyRequest;
use App\Modules\Core\Http\Controllers\AuthController;

class RegencyController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $this->getAll($request, $this->table->orderBy('id', 'DESC'));
        $model = Regency::orderBy('id', 'DESC');
        try {
            $perPage = empty($request->perPage) ? 20 : $request->perPage;
            $all = empty($request->all) ? false : true;

            if (!empty($request->q)) {
                $model->where('name', 'like', '%'.$request->q.'%');
            }
            if (!empty($request->provinsi_id)) {
                $model->where('provincy_id', '=', $request->provinsi_id);
            }

            $model->with(['provincy']);

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
    public function store(RegencyRequest $request)
    {
        return $this->create($request->all(), Regency::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Regency::class, ['provincy', 'subdistricts']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegencyRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Regency::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, Regency::class);
    }
}


