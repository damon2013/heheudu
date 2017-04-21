<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_status', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned()->comment('用户id');
            $table->integer('vip_state')->unsigned()->default(0)->comment('vip状态 0非会员 1普通会员  2高级会员');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vip_status');
    }
}
