<?php

use Illuminate\Database\Seeder;

class ProblemsTableSeeder extends Seeder
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
            DB::table('problems')->insert([
                'type' => 'significant',
                'code' => $faker->ean8,
                'name' => 'Asthma',
                'status' => 'Active Problem',
                'start_time' => $faker->date,
                'action' => 'Combine',
                'duration' => '6 mon',
                'end_time' => $faker->date,
                'consultation_id' => 3,
                'patient_id' => 1
            ]);
        endfor;
        for($i = 0; $i < 3; $i ++):
            DB::table('problems')->insert([
                'type' => 'minor',
                'code' => $faker->ean8,
                'name' => 'Chronic obstructive pulmonary disease',
                'status' => 'Past/Ended Problem',
                'start_time' => $faker->date,
                'action' => 'Group',
                'duration' => '1 yr',
                'end_time' => $faker->date,
                'consultation_id' => 2,
                'patient_id' => 1
            ]);
        endfor;
        for($i = 0; $i < 3; $i ++):
            DB::table('problems')->insert([
                'type' => 'significant',
                'code' => $faker->ean8,
                'name' => 'High risk of  diabetes mellitus',
                'status' => 'Past/Ended Problem',
                'start_time' => $faker->date,
                'action' => 'Group',
                'duration' => '1 yr',
                'end_time' => $faker->date,
                'consultation_id' => 1,
                'patient_id' => 1
            ]);
        endfor;
    }
}
