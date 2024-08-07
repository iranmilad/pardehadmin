<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserAuestion extends Model
{

	protected $fillable=[
        "id","user_id","type","title","question","answerd_at","answerd_by"
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
