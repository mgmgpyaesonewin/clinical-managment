<?php

use Illuminate\Database\Seeder;

class InvestigationsTableSeeder extends Seeder
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
            DB::table('investigations')->insert([
                'term' => 'Expected peak flow rate x 50%',
                'value' => '225.0 L/mn',
                'consultation_id' => 1,
                'doctor_id' => 1,
                'code' => $faker->ean8,
                'snomed_ct' => $faker->ean13,
                'range' => '(75-140)',
                'type' => 'i'
            ]);
        endfor;
       
        for($i = 0; $i < 3; $i ++):
            DB::table('investigations')->insert([
                'term' => 'Alcohol consumption',
                'value' => '0U/week',
                'consultation_id' => 2,
                'doctor_id' => 1,
                'code' => $faker->ean8,
                'snomed_ct' => $faker->ean13,
                'range' => '(75-140)',
                'type' => 'i'
            ]);
        endfor;

        for($i = 0; $i < 3; $i ++):
            DB::table('investigations')->insert([
                'term' => 'Best ever peak expiratory flow rate',
                'value' => '450 L/mn',
                'consultation_id' => 3,
                'doctor_id' => 1,
                'code' => $faker->ean8,
                'snomed_ct' => $faker->ean13,
                'range' => '(75-140)',
                'type' => 'i'
            ]);
        endfor;
    
    }
}
