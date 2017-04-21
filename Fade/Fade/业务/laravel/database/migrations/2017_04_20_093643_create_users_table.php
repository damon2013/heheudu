<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //应用信息
            $table->integer('version_id')->unsigned()->index()->comment('Api版本号');
            $table->string('token')->comment('token');
            //基础信息
            $table->string('nickname', 30)->default('佚名')->comment('昵称');
            $table->string('birthday', 30)->comment('生日');
            $table->string('bconstellation', 30)->comment('星座');
            $table->string('fade_dec')->default('说点什么吧朋友')->comment('简介');
            $table->string('avatar', 200)->default('uploads/user/default/avatar.jpg')->comment('头像');
            $table->string('mobile', 11)->unique()->index()->comment('手机号码');
            $table->string('wechat_number')->unique()->comment('微信号码');
            $table->tinyInteger('sex')->default(0)->comment('性别 0女 1男');
            //照骗
            $table->integer('photo_userId')->unsigned()->comment('属于某个照骗组');
            $table->integer('location_userId')->unsigned()->comment('位置');
            
             //期望
            $table->integer('hope_partner_userId')->unsigned()->index()->comment('期望对象的状态');
            
            //状态信息
            $table->integer('basic_status_userId')->unsigned()->index()->comment('用户账号状态');
            $table->integer('vip_status_userId')->unsigned()->index()->comment('vip状态');
            //认证状态
            $table->integer('auth_identity_userId')->unsigned()->index()->comment('认证状态(身份证)');
            $table->integer('auth_house_userId')->unsigned()->comment('房子认证信息');
            $table->integer('auth_edu_IuserId')->unsigned()->comment('学历认证信息');
            $table->integer('auth_job_userId')->unsigned()->comment('学历认证信息');

            //详细信息
            $table->integer('person_height')->unsigned()->comment('身高');
            $table->integer('person_weight')->unsigned()->comment('体重');
            $table->string('in_province',30)->default('北京')->comment('所在省');
            $table->string('in_city',30)->default('北京')->comment('所在城市');
            $table->string('home_province',30)->default('北京')->comment('老家在省');
            $table->string('home_city',30)->default('北京')->comment('老家所在市');
            $table->integer('education')->unsigned()->comment('学历');
            $table->integer('hope_marry_date')->unsigned()->comment('期望结婚的时间');
            $table->integer('salary_min')->unsigned()->comment('月收入最低');
            $table->integer('salary_max')->unsigned()->comment('月收入最高');
            $table->integer('marry_state')->unsigned()->comment('婚姻状态');
            $table->tinyInteger('have_son')->default(0)->comment('0没孩子 1有孩子');
            $table->integer('smoke_state')->unsigned()->comment('抽烟状态');
            $table->integer('family_sort')->unsigned()->comment('家庭排行');
            $table->integer('parent_state')->unsigned()->comment('父母状态');
            $table->integer('date_like')->unsigned()->comment('约会方式');

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
        Schema::drop('users');
    }
}
