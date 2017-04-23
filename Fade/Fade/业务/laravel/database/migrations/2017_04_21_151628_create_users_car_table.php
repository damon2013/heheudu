<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_car', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('userid');
            $table->integer('auth_car_state')->unsigned()->comment('0未认证 1认证中 2 已认证');
            $table->string('user_car_brand_name',50)->comment('汽车名称');
            $table->string('user_car_img_url',300)->comment('汽车照片');
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
        Schema::drop('users_car');
    }
}
