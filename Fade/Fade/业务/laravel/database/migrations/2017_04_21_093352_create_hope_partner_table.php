<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hope_partner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('结婚与否');
            $table->integer('edu_max')->unsigned()->comment('最高学历');
            $table->integer('edu_min')->unsigned()->comment('最低学历');
            $table->integer('age_max')->unsigned()->comment('最高年龄');
            $table->integer('age_min')->unsigned()->comment('最低年龄');
            $table->integer('house_state')->unsigned()->comment('有房没房');
            $table->integer('car_state')->unsigned()->comment('有车没车');
            $table->string('in_city',30)->default('北京')->comment('所在城市');
            $table->integer('salary_min')->unsigned()->comment('月收入最低');
            $table->integer('salary_max')->unsigned()->comment('月收入最高');
            $table->integer('marry_state')->unsigned()->comment('结婚与否');
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
        Schema::drop('hope_partner');
    }
}
