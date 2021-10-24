<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class visitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $arr = [2, 4, 8, 9];
        for ($i = 0; $i < 100; $i++) {
            DB::table('1_visitors')->insert([
                'name' => $faker->name(),
                'addresser' => $arr[array_rand($arr)],
                'date' => $faker->date(),
                'time' => $faker->time(),
                'doc_type' => $faker->randomElement(['Citizenship', 'Passport', 'Driving Lisense']),
                'doc_id' => $faker->numberBetween(100000, 10000000),
                'father_name' => $faker->name('male'),
                'issue_date' => $faker->date(),
                'exp_date' => $faker->date()
            ]);
        }
    }
}
