<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')
                    ->withPivot([
                        'read_all',
                        'read_same_role',
                        'read_own',
                        'write_all',
                        'write_same_role',
                        'write_own'
                    ]);
    }
}
