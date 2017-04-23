<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_job extends Model
{
    //
    public $table = 'users_job';
    protected $guarded = ['auth_job_state'];
}
