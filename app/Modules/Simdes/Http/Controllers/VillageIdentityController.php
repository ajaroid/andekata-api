<?php

namespace App\Modules\Simdes\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Modules\Simdes\Models\VillageIdentity;
use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Simdes\Http\Requests\VillageIdentityRequest;

class VillageIdentityController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, VillageIdentity::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillageIdentityRequest $request)
    {
        return $this->create($request->all(), VillageIdentity::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, VillageIdentity::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VillageIdentityRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, VillageIdentity::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, VillageIdentity::class);
    }

    /**
     * Upload image resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|mimes:jpeg,jpg,png,gif,bmp|max:512|dimensions:max_width=480,max_height=480'
            ]);

            $image = $request->file('logo');
            $upload = $image->store('village-identity/logo', 'public');

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
