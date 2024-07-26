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
        return $this->belongsToMany(Permission::class, 'role_permission')->withPivot('access_code');
    }

    /**
     * بررسی دسترسی به کد دسترسی خاص از نظر نوع (خواندن یا نوشتن)
     *
     * @param string $permissionName
     * @param string $type
     * @return bool
     */
    public function hasPermission($permissionName, $type = 'read')
    {
        // تعیین مقدار مناسب برای مقایسه دسترسی
        $requiredCode = $type === 'write' ? '2' : '1';

        // بررسی دسترسی بر اساس نوع
        return $this->permissions()
                    ->where('name', $permissionName)
                    ->wherePivot('access_code', '>=', $requiredCode)
                    ->exists();
    }

    /**
     * بررسی دسترسی خواندن
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasReadPermission($permissionName)
    {
        return $this->hasPermission($permissionName, 'read');
    }

    /**
     * بررسی دسترسی نوشتن
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasWritePermission($permissionName)
    {
        return $this->hasPermission($permissionName, 'write');
    }

}
