<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_identity extends Model
{
    //
    public $table = 'users_identity';
    protected $guarded = ['auth_identity_state'];
}
