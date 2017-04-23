<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User_Big_House extends Model
{
    //
    public $table = 'user_big_house';
    protected $guarded = ['auth_house_state'];
}
