<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin', 'user_role', 'role_id', 'user_id');
    }
}
