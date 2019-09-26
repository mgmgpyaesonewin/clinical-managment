<?php

use Illuminate\Database\Seeder;

class ConsultationsTableSeeder extends Seeder
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
            DB::table('consultations')->insert([
                'title' => 'GP Surgery',
                'comment' => $faker->text,
                'patient_id' => 1,
                'doctor_id' => 1,
                'appointment_id' => 1,
            ]);
        endfor;
        for($i = 0; $i < 3; $i ++):
            DB::table('consultations')->insert([
                'title' => 'JS Medical Practice',
                'comment' => $faker->text,
                'patient_id' => 2,
                'doctor_id' => 1,
                'appointment_id' => 1,
            ]);
        endfor;
        for($i = 0; $i < 3; $i ++):
            DB::table('consultations')->insert([
                'title' => 'JS Medical Practice - Philip Lane Sites',
                'comment' => $faker->text,
                'patient_id' => 3,
                'doctor_id' => 1,
                'appointment_id' => 1,
            ]);
        endfor;
    }
}
