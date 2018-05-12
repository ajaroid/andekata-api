<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Group;
use Illuminate\Validation\ValidationException;
use App\Modules\Core\Http\Requests\GroupRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GroupController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getAll($request, Group::class, ['users']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\GroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        return $this->create($request->all(), Group::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getById($id, Group::class, ['users', 'privileges']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Core\Http\Requests\GroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        return $this->updateById($request->all(), $id, Group::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = Group::with(['users'])->findOrFail($id)->users;
        if (count($users)) {
            throw new HttpException(422, 'this Group already have user');
        } else {
            return $this->deleteById($id, Group::class);
        }
    }

    /**
     * Update users assigned to this group
     *
     * @param  \Illuminate\Http\Request; $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUsers(Request $request, $id)
    {
        $userIds = $request->userIds;

        try {
            $group = Group::findOrFail($id);

            $group->updateUsers($userIds);
            $updated = Group::with(['users'])->findOrFail($id);

            return $this->jsonResponseSuccess([
                'data' => $updated
            ], 'Success Update Users');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Add Privilege specified
     *
     * @param int $id
     * @param string $name
     *
     * @return \Illuminate\Http\Response
     */
    public function addPrivilege($id, $name)
    {
        try {
            $group = Group::findOrFail($id);

            if ($group->hasPrivilege($name)) {
                throw new HttpException(409, 'Privilege ' . $name . ' already exist at this group');
            } else {
                $group->addPrivilege($name);
                return $this->jsonResponseSuccess([], 'Success Add Privilege '.$name);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove Privilege specified or all
     *
     * @param int $id
     * @param string $name [name of privilege or all for remove privilege]
     *
     * @return \Illuminate\Http\Response
     */
    public function removePrivilege($id, $name)
    {
        try {
            $group = Group::findOrFail($id);

            if ($name == 'all') {
                if (count($group->privileges->toArray()) > 0) {
                    $group->removeAllPrivilege();
                    return $this->jsonResponseSuccess([], 'Success Remove All Privileges');
                } else {
                    throw new HttpException(404, 'Privileges not found at this group');
                }
            } else {
                if ($group->hasPrivilege($name)) {
                    $group->removePrivilege($name);
                    return $this->jsonResponseSuccess([], 'Success Revoke Group '.$name);
                } else {
                    throw new HttpException(404, 'Privilege ' . $name . ' not found at this group');
                }
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * update group privileges using array of privilege id
     */
    public function updatePrivileges(Request $request, $groupId)
    {
        try {
            $privileges = $request->input('privileges');
            $group = Group::findOrFail($groupId);
            $group->privileges()->detach();
            $group->privileges()->attach($privileges);

            return $this->jsonResponseSuccess([
                'data' => Group::with(['privileges'])->findOrFail($groupId)
            ], 'Success Update Privileges at Group '.$group->name);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }
}
