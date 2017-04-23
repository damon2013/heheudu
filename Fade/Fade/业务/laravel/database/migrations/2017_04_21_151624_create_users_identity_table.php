<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_identity', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned()->index()->comment('userid');
             $table->integer('auth_identity_state')->unsigned()->comment('0未认证 1认证中 2 已认证');
             $table->string('auth_identity_number',50)->comment('身份证号');
             $table->string('auth_identity_name',30)->comment('名字');
             $table->string('auth_identity_img_f_url',300)->comment('认证照片正面');
             $table->string('auth_identity_img_b_url',300)->comment('认证照片背面');
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
        Schema::drop('users_identity');
    }
}
