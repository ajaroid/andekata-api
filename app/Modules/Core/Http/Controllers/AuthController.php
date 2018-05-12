<?php

namespace App\Modules\Core\Http\Controllers;

use Auth;
use JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Modules\Core\Models\User;
use App\Modules\Core\Models\Group;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Modules\Core\Helpers\JsonResponseTrait;
use App\Modules\Core\Http\Requests\LoginRequest;
use App\Modules\Core\Http\Requests\RegisterRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    use JsonResponseTrait;

    protected function getJwtToken(array $credentials)
    {
        try {
            //TODO : better error here Yuana
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                throw new HttpException(401, "Email or password doesn't match");
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            throw new HttpException(500, 'Could not Create Token');
        }
        // all good so return the token
        return $token;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if ($user->isSystem()) throw new HttpException(401, 'User not valid');
        if ($user->isNotActive()) {
            throw new HttpException(401, 'User is not active');
        }

        try {
            $token = $this->getJwtToken($credentials);

            $user->load([
                'groups:id,name',
                'groups.privileges:id,name,label,menu',
                'employee.village.villageIdentity'
            ]);

            $priviliges = collect($user->groups)
                            ->flatMap(function ($group) {
                                return $group->privileges;
                            })
                            ->unique('id');

            return $this->jsonResponseSuccess([
                'data' => [
                    'user' => $user,
                    'all_privileges' => $priviliges,
                    'token' => $token
                ]
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => User::STATUS_PENDING,
                'registered_at' => date('Y-m-d h:i:s')
            ]);

            return $this->jsonResponseSuccess([
                'data' => [
                    'user' => User::findOrFail($user->id)
                ]
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function getAll(Request $request, $modelClass, $relations = [])
    {
        try {

            $model = $modelClass::orderBy('id', 'DESC');

            /**
             * hidden user system, superadmin
             */
            if ($modelClass == User::class || $modelClass == Group::class) {
                $model->whereNotIn('id', [1, 2]);
            }

            $perPage = empty($request->perPage) ? 20 : $request->perPage;
            $all = empty($request->all) ? false : true;

            if (!empty($request->q)) {
                $field = empty($request->field) ? 'name' : $request->field;

                if (!Schema::hasColumn(with(new $modelClass)->getTable(), $field)) {
                    throw new HttpException(404, 'Field '.$field.' not found!');
                }

                $model->where($field, 'like', '%'.$request->q.'%');
            }

            if (count($relations)) {
                $model->with($relations);
            }

            // add limit even user query all result,
            // well, user will not scroll over thousands of result at once,
            // and will usually want to filter the result
            // so adding limit here make sense
            $data = $all ? $model->limit(200)->get() : $model->paginate($perPage);

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    protected function create($request, $modelClass)
    {
        try {
            $data = $modelClass::create($request);

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    protected function getById($id, $modelClass, $relations = [])
    {
        try {
            if (count($relations)) {
                $data = $modelClass::with($relations)->findOrFail($id);
            } else {
                $data = $modelClass::findOrFail($id);
            }

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    protected function updateById(array $request, $id, $modelClass)
    {
        try {
            $data = $modelClass::findOrFail($id);

            $data->update($request);

            return $this->jsonResponseSuccess([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    protected function deleteById($id, $modelClass)
    {
        try {
            $data = $modelClass::findOrFail($id)->delete();

            return $this->jsonResponseSuccess([], 'Delete success');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
