<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthorizeAccess
{
    protected $permissionName;

    public function __construct()
    {
        // Initialize the permission name if necessary
    }

    public function setPermissionName(string $permissionName)
    {
        $this->permissionName = $permissionName;
    }

    protected function hasAccess($accessType)
    {
        // Check if the current user has the specified access type.
        return Auth::user()->role->hasPermission($this->permissionName, $accessType);
    }

    protected function filterQueryByPermission($query, $accessType)
    {
        $user = Auth::user();
        $userRoleId = $user->role_id;
        $userId = $user->id;

        // بررسی وجود user در مدل
        $hasUserRelation = $query->getModel() instanceof User;

        switch ($accessType) {
            case 'read_same_role':
                if ($this->canReadSameRole($this->permissionName)) {
                    if ($hasUserRelation) {
                        return $query->whereIn('id', function($subQuery) use ($userRoleId) {
                            $subQuery->select('id')
                                     ->from('users')
                                     ->where('role_id', $userRoleId);
                        });
                    } else {
                        return $query->whereIn('user_id', function($subQuery) use ($userRoleId) {
                            $subQuery->select('id')
                                     ->from('users')
                                     ->where('role_id', $userRoleId);
                        });
                    }
                }
                break;

            case 'read_own':
                if ($this->canReadOwn($this->permissionName)) {
                    if ($hasUserRelation) {
                        return $query->where('id', $userId);
                    } else {
                        return $query->where('user_id', $userId);
                    }
                }
                break;

            case 'write_own':
                if ($this->canWriteOwn($this->permissionName)) {
                    if ($hasUserRelation) {
                        return $query->where('id', $userId);
                    } else {
                        return $query->where('user_id', $userId);
                    }
                }
                break;

            // در صورت نیاز می‌توان موارد دیگری نیز اضافه کرد
            default:
                break;
        }

        return $query;
    }


    public function canReadAll($permissionName)
    {
        return Auth::user()->role->canReadAll($permissionName);
    }

    public function canReadSameRole($permissionName)
    {
        return Auth::user()->role->canReadSameRole($permissionName);
    }

    public function canReadOwn($permissionName)
    {
        return Auth::user()->role->canReadOwn($permissionName);
    }

    public function canWriteAll($permissionName)
    {
        return Auth::user()->role->canWriteAll($permissionName);
    }

    public function canWriteSameRole($permissionName)
    {
        return Auth::user()->role->canWriteSameRole($permissionName);
    }

    public function canWriteOwn($permissionName)
    {
        return Auth::user()->role->canWriteOwn($permissionName);
    }

    public function authorizeAction($model)
    {
        // پیدا کردن مدل بر اساس شناسه

        $user = Auth::user();
        $userId = $user->id;
        $userRoleId = $user->role_id;


        if ($this->hasAccess('write_all')) {
            
        }
        elseif ($model->user) {
            // اگر مدل دارای رابطه‌ی user باشد
            // بررسی دسترسی write_same_role: فقط کاربران با نقش مشابه را تغییر دهند
            if ($this->hasAccess('write_same_role') && $model->user->role_id == $userRoleId) {
                // دسترسی به تغییر کاربران با نقش مشابه
            }
            // بررسی دسترسی write_own: فقط کاربران خودشان را تغییر دهند
            elseif ($this->hasAccess('write_own') && $model->user_id == $userId) {
                // دسترسی به تغییر خود
            }
            else {
                abort(403, 'Unauthorized action. You do not have permission to edit this item.');
            }
        }
        else {
            // اگر مدل دارای رابطه‌ی user نباشد
            // بررسی دسترسی write_same_role: فقط کاربران با نقش مشابه را تغییر دهند
            if ($this->hasAccess('write_same_role') && $model->role_id == $userRoleId) {
                // دسترسی به تغییر کاربران با نقش مشابه
            }
            // بررسی دسترسی write_own: فقط کاربران خودشان را تغییر دهند
            elseif ($this->hasAccess('write_own') && $model->id == $userId) {
                // دسترسی به تغییر خود
            }
            else {
                abort(403, 'Unauthorized action. You do not have permission to edit this item.');
            }
        }



    }

    public function applyAccessControl($query)
    {
        if ($this->canReadAll($this->permissionName)) {
            return $query;
        }

        if ($this->canReadSameRole($this->permissionName)) {
            return $this->filterQueryByPermission($query, 'read_same_role');
        }

        return $this->filterQueryByPermission($query, 'read_own');
    }



}
