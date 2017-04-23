<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    //
    public $table = 'users';
    protected $guarded = ['basic_status_userId','vip_status_userId',
    'auth_identity_userId','auth_house_userId','auth_edu_IuserId','auth_job_userId'];
     
}
