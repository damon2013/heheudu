<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_car extends Model
{
    //
    public $table = 'users_car';
    protected $guarded = ['auth_car_state'];
}
