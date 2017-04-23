<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class uses extends Model
{
    //
    public $table = 'users';
    protected $guarded = ['views','user_id','updated_at','created_at'];
}
