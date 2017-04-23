<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_job', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('userid');
             $table->integer('auth_job_state')->unsigned()->comment('0未认证 1认证中 2 已认证');
             $table->string('auth_job_name',50)->comment('职业');
             $table->string('auth_job_level_name',50)->comment('职业名称');
             $table->string('auth_job_compny_name',50)->comment('公司名称');
             $table->string('auth_job_img_url',300)->comment('认证照片');
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
        Schema::drop('users_job');
    }
}
