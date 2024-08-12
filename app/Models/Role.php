<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'display_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
                    ->withPivot([
                        'read_all',
                        'read_same_role',
                        'read_own',
                        'write_all',
                        'write_same_role',
                        'write_own'
                    ]);
    }

    /**
     * بررسی دسترسی به کد دسترسی خاص از نظر نوع
     *
     * @param string $permissionName
     * @param string $accessType
     * @return bool
     */
    public function hasPermission($permissionName, $accessType='read_own')
    {
        return $this->permissions()
                    ->where('name', $permissionName)
                    ->wherePivot($accessType, true)
                    ->exists();
    }

    public function canReadAll($permissionName)
    {
        return $this->hasPermission($permissionName, 'read_all');
    }

    public function canReadSameRole($permissionName)
    {
        return $this->hasPermission($permissionName, 'read_same_role');
    }

    public function canReadOwn($permissionName)
    {
        return $this->hasPermission($permissionName, 'read_own');
    }

    public function canWriteAll($permissionName)
    {
        return $this->hasPermission($permissionName, 'write_all');
    }

    public function canWriteSameRole($permissionName)
    {
        return $this->hasPermission($permissionName, 'write_same_role');
    }

    public function canWriteOwn($permissionName)
    {
        return $this->hasPermission($permissionName, 'write_own');
    }
}
