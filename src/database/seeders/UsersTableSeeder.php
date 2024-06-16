<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '銭形',
            'email' => 'zenigata@gmail.com',
            'password' => 'hiro0530'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '石川',
            'email' => 'ishikawa@gmail.com',
            'password' => 'hiro0530'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '次元',
            'email' => 'jigen@gmail.com',
            'password' => 'hiro0530'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '峰',
            'email' => 'mine@gmail.com',
            'password' => 'hiro0530'
        ];
        DB::table('users')->insert($param);
    }
}
