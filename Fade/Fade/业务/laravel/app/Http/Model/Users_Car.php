<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_Car extends Model
{
    //
    public $table = 'users_car';
    protected $guarded = ['auth_car_state'];
}
