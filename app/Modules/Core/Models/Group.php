<?php

namespace App\Modules\Core\Models;

class Group extends TrackableModel
{

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'groups_users', 'groups_id', 'users_id');
    }

    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, 'privileges_groups', 'groups_id', 'privileges_id');
    }

    public function updateUsers($ids)
    {
        return $this->users()->sync($ids);
    }

    /**
     * [hasPrivilege check determine if the group has privilege same at the argument]
     * @param  [string]  $name
     * @return boolean
     */
    public function hasPrivilege($name)
    {
        foreach ($this->privileges as $privilege) {
            if ($privilege->name === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * [addPrivilege]
     * @param [string] $privilege privilege name
     * @return [void]
     */
    public function addPrivilege($privilege)
    {
        if (is_string($privilege)) {
            $privilege = Privilege::where('name', $privilege)->firstOrFail();
        }
        return $this->privileges()->attach($privilege);
    }

    /**
     * [removePrivilege]
     * @param  [string] $privilege privilege name
     * @return [void]
     */
    public function removePrivilege($privilege)
    {
        if (is_string($privilege)) {
            $privilege = Privilege::where('name', $privilege)->firstOrFail();
        }
        return $this->privileges()->detach($privilege);
    }

    public function removeAllPrivilege()
    {
        return $this->privileges()->detach();
    }
}
