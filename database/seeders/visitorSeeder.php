<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\zh_CN\Payment as chin;
use Illuminate\Support\Facades\Hash;

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
        $arr = [3, 4, 5, 6, 7];
        $gender = ["Male", "Female", "Not Specified"];
        for ($i = 10; $i > 0; $i--) {
            for ($j = 3; $j < 8; $j++) {
                $ent = $faker->time('H:i:s');
                $end = date('H:i:s', strtotime($ent) + 8 * 60 * 60);
                DB::table('2_attendence')->insert([
                    'staff_id' => $j,
                    'entry_time' => $ent,
                    'exit_time' => $end,
                    'date' => date('Y-m-d', strtotime(date('Y-m-d') . " - $i day")),
                    'section_name' => $faker->randomElement(['apple', 'mango', 'banana'])
                ]);
                $ent = $faker->time('H:i:s');
                $end = date('H:i:s', strtotime($ent) + 8 * 60 * 60);
                DB::table('3_attendence')->insert([
                    'staff_id' => $j,
                    'entry_time' => $ent,
                    'exit_time' => $end,
                    'date' => date('Y-m-d', strtotime(date('Y-m-d') . " - $i day")),
                    'section_name' => $faker->randomElement(['apple', 'mango', 'banana'])
                ]);
            }
        }
        // for ($i = 0; $i < 76; $i++) {
        //     $id = $faker->randomElement($arr);
        //     $dt = $faker->dateTimeBetween($startDate = '-3 day', $endDate = 'now');
        //     $date = $dt->format("Y-m-d");
        //     DB::table('3_visitors')->insert([
        //         'name' => $faker->name(),
        //         'name_ch' => $faker->name(),
        //         'addresser_id' => $id,
        //         'sex' => $faker->randomElement($gender),
        //         'section_name' => $faker->randomElement(['apple', 'mango', 'banana']),
        //         'dob' => $faker->date('Y-m-d', 'now'),
        //         'phone' => $faker->phoneNumber(),
        //         'address' => $faker->address(),
        //         'purpose' => $faker->realText(),
        //         'date' => $date,
        //         'time' => $faker->time(),
        //         'doc_type' => $faker->randomElement(['Citizenship', 'Passport', 'Driving Lisense']),
        //         'doc_id' => $faker->numberBetween(100000, 10000000),
        //         'father_name' => $faker->name('male'),
        //         'issue_date' => $faker->date(),
        //         'exp_date' => $faker->date()
        //     ]);
        //     $id = $faker->randomElement($arr);
        //     $dt = $faker->dateTimeBetween($startDate = '-3 day', $endDate = 'now');
        //     $date = $dt->format("Y-m-d");
        //     DB::table('2_visitors')->insert([
        //         'name' => $faker->name(),
        //         'name_ch' => $faker->name(),
        //         'addresser_id' => $id,
        //         'sex' => $faker->randomElement($gender),
        //         'section_name' => $faker->randomElement(['apple', 'mango', 'banana']),
        //         'dob' => $faker->date(),
        //         'phone' => $faker->phoneNumber(),
        //         'address' => $faker->address(),
        //         'purpose' => $faker->realText(),
        //         'date' => $date,
        //         'time' => $faker->time(),
        //         'doc_type' => $faker->randomElement(['Citizenship', 'Passport', 'Driving Lisense']),
        //         'doc_id' => $faker->numberBetween(100000, 10000000),
        //         'father_name' => $faker->name('male'),
        //         'issue_date' => $faker->date(),
        //         'exp_date' => $faker->date()
        //     ]);
        // }
    }
}
