<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers = [
            "1人",
            "2人",
            "3人",
            "4人",
            "5人",
            "6人",
            "7人",
            "8人",
            "9人",
            "10人"
        ];
        foreach($numbers as $number) {
            DB::table('counts')->insert([
                'number' => $number
            ]);
        }
    }
}
