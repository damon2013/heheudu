<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_Job extends Model
{
    //
     public $table = 'users_job';
    protected $guarded = ['auth_job_state'];
}
