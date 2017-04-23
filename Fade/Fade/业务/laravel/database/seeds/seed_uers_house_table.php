<?php

use Illuminate\Database\Seeder;

class seed_uers_house_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_big_house')->insert([
            [
                'user_id' => 33,
                'auth_house_state' => 1,
                'auth_house_province' => '北京',
                'auth_house_city' => '北京',
                'auth_house_img_url' => 'testurl',
            ], [
               'user_id' => 33,
                'auth_house_state' => 1,
                'auth_house_province' => '北京1',
                'auth_house_city' => '北京111',
                'auth_house_img_url' => 'testurl',
            ], [
               'user_id' => 33,
                'auth_house_state' => 1,
                'auth_house_province' => '北4444京',
                'auth_house_city' => '北44444京',
                'auth_house_img_url' => 'testurl',
            ]
        ]);
    }
}
