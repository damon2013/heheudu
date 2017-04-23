<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_Edu extends Model
{
    //
     public $table = 'users_edu';
    protected $guarded = ['auth_edu_state'];
}
