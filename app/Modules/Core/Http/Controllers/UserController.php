<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Core\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Modules\Core\Http\Requests\UserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, User::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            \DB::transaction(function () use($request) {

                $data = User::create([
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'status' => User::STATUS_PENDING,
                    'registered_at' => date('Y-m-d h:i:s'),
                    'employee_id' => $request->employee_id
                ]);

                if (\Auth::user()->isAdmin()) {
                    $data->assignGroup("petugas");
                }

                return $this->jsonResponseSuccess([
                    'data' => $data
                ]);
            });

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, User::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = [
            'email' => $request->email,
            'username' => $request->username,
            'status' => $request->status,
            'employee_id' => $request->employee_id
        ];

        return $this->updateById($data, $id, User::class);
    }

    public function passwordReset(Request $request, $id)
    {
        try {
            $input = $request->only(['password', 'password_new', 'password_new_confirmation']);

            $request->validate([
                'password' => 'required|min:6',
                'password_new' => 'required|min:6|confirmed'
            ]);

            $user = User::findOrFail($id);

            if (Hash::check($input['password'], $user->password)) {

                $user->password = Hash::make($input['password_new']);
                $user->save();

                return $this->jsonResponseSuccess([], 'Success Reset Password');

            } else {
                throw new HttpException(400, 'Please enter valid old password!');
            }

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteById($id, User::class);
    }

    /**
     * Revoke Group specified or all
     *
     * @param int $id
     * @param string $name [name of group or all for revoke all group]
     *
     * @return \Illuminate\Http\Response
     */
    public function revokeGroup($id, $name)
    {
        try {
            $user = User::findOrFail($id);

            if ($name == 'all') {
                if (count($user->groups->toArray()) > 0) {
                    $user->revokeAllGroup();
                    return $this->jsonResponseSuccess([], 'Success Revoke All Groups');
                } else {
                    throw new HttpException(404, 'Groups not found at this user');
                }
            } else {
                if ($user->hasGroup($name)) {
                    $user->revokeGroup($name);
                    return $this->jsonResponseSuccess([], 'Success Revoke Group '.$name);
                } else {
                    throw new HttpException(404, 'Group ' . $name . ' not found at this user');
                }
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Assign Group specified
     *
     * @param int $id
     * @param string $name
     *
     * @return \Illuminate\Http\Response
     */
    public function assignGroup($id, $name)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->hasGroup($name)) {
                throw new HttpException(409, 'Group ' . $name . ' already exist at this user');
            } else {
                $user->assignGroup($name);
                return $this->jsonResponseSuccess([], 'Success Assign Group '.$name);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
