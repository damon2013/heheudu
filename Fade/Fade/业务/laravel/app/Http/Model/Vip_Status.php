<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Vip_Status extends Model
{
    //
    public $table = 'vip_status';
    protected $guarded = ['vip_state'];
}
