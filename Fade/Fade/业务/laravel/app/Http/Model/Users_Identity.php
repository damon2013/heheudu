<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_Identity extends Model
{
    //
    public $table = 'users_identity';
    protected $guarded = ['auth_identity_state'];
}
