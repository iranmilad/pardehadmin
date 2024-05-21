<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberList extends Model
{

    protected $fillable = ["id", "title", "description"];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_member_lists', 'member_list_id', 'user_id');
    }

    public function subscribes()
    {
        return $this->hasMany(SubscribeAccessibility::class, "reference_id", "id")->where('reference_type', 3);
    }

    public function getAccessibilityAttribute()
    {
        if ($this->subscribes->count() > 0) {
            if (auth()->check()) { //check user ligined
                $user = auth()->user(); //get logined user
                $userSubscribe = $user->subscribe; //user current subscribe
                if ($userSubscribe) {
                    $activeSubscribes = $this->subscribes()->where('subscribe_id', $userSubscribe->subscribe_id)->first();
                    if ($activeSubscribes) { // if has subscribe
                        return true;
                    }
                }
            }
        } else {
            return true;
        }
        return false;
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

}
