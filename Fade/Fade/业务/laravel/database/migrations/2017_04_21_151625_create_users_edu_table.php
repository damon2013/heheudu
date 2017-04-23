<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersEduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_edu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('userid');
            $table->integer('auth_edu_state')->unsigned()->comment('0未认证 1认证中 2 已认证');
             $table->string('user_edu_name',50)->comment('学校名字');
             $table->string('user_edu_level_name',50)->comment('学历名称');
             $table->integer('user_edu_level')->unsigned()->comment('学历');
              $table->string('user_edu_img_url',300)->comment('毕业证书照片');
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
        Schema::drop('users_edu');
    }
}
