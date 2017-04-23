<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_edu extends Model
{
    //
    public $table = 'users_edu';
    protected $guarded = ['auth_edu_state'];
}
