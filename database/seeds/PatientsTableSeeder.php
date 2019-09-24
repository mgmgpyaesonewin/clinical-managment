<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); 
        for($i = 0; $i < 3; $i ++):
            DB::table('patients')->insert([
                'name' => $faker->name,
                'dob' => $faker->date,
                'gender' => 'Male',
                'user_id' => 1,
                'hospital_id' => 1,
                'address' => $faker->address,
                'city' => $faker->city,
                'phone_number' => $faker->phoneNumber,
            ]);
        endfor;
    }
}
