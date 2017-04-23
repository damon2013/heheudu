<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserbigHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_big_house', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned()->index()->comment('user id');
             $table->integer('auth_house_state')->unsigned()->comment('0未认证 1认证中 2 已认证');
             $table->string('auth_house_province',30)->default('北京')->comment('所在省');
             $table->string('auth_house_city',30)->default('北京')->comment('所在城市');
             $table->string('auth_house_img_url',300)->comment('认证照片');
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
        Schema::drop('user_big_house');
    }
}
