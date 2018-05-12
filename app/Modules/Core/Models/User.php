<?php

namespace App\Modules\Core\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * @var users status constant
     */
    const STATUS_PENDING    = 0;
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'registered_at',
        'status',
        'employee_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    protected $with = ['createdBy', 'updatedBy', 'employee'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isNotActive()
    {
        return ($this->status == User::STATUS_PENDING or $this->status == User::STATUS_INACTIVE);
    }

    public function isActive()
    {
        return $this->status == User::STATUS_ACTIVE;
    }

    public function isSystem()
    {
        return $this->id === 1;
    }

    public function isSuperAdmin()
    {
        return $this->id === 2;
    }

    public function isAdmin()
    {
        return $this->id === 3;
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'groups_users', 'users_id', 'groups_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    /**
     * [hasGroup check determine if the user has group same at the argument]
     * @param  [string]  $name group name
     * @return boolean
     */
    public function hasGroup($name)
    {
        foreach ($this->groups as $group) {
            if ($group->name === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * [assignGroup]
     * @param  [string] $group group name
     * @return [void]
     */
    public function assignGroup($group)
    {
        if (is_string($group)) {
            $group = Group::where('name', $group)->firstOrFail();
        }
        return $this->groups()->attach($group);
    }

    /**
     * [revokeGroup]
     * @param  [string] $group group name
     * @return [void]
     */
    public function revokeGroup($group)
    {
        if (is_string($group)) {
            $group = Group::where('name', $group)->firstOrFail();
        }
        return $this->groups()->detach($group);
    }

    public function revokeAllGroup()
    {
        return $this->groups()->detach();
    }
}
