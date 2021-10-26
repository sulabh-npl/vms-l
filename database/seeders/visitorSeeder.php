<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\zh_CN\Payment as chin;

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
        // $faker_ch = chin::create();
        $arr = [4, 5, 6];
        $gender = ["Male", "Female", "Not Specified"];
        for ($i = 0; $i < 100; $i++) {
            $id = $faker->randomElement($arr);
            $name = DB::table('1_staff')->where('id', "=", $id)->first()->name;
            DB::table('1_visitors')->insert([
                'name' => $faker->name(),
                'name_ch' => $faker->name(),
                'addresser_id' => $id,
                'addresser' => $name,
                'sex' => $faker->randomElement($gender),
                'section_name' => $faker->randomElement(['floor 1', 'floor 2', 'floor 3']),
                'dob' => $faker->date(),
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'purpose' => $faker->realText(),
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
