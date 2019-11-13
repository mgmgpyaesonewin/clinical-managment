<?php

namespace Tests\Feature;

use App\Patient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    // use RefreshDatabase;
    
    /** @test **/
    public function a_patient_can_book_a_doctor()
    {
        $user = factory(User::class)->create();
        $doctor = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $faker = \Faker\Factory::create(); 
        $tomorrow =  Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+01 days')->getTimestamp());
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $tomorrow)->addHours(3);
        $this->actingAs($user, 'api')->post('/api/sessions', [
            'date'  =>  $tomorrow->format('d-m-Y'),
            'start_time'=>  $tomorrow->format('H:i'),
            'end_time'=> $end_time->format('H:i'),
            'interval'=> 15,
            'doctor_id'  =>  $doctor->id,
        ]);
        $response = $this->actingAs($user, 'api')->get('/api/sessions?id=1');
        $response->dump();
        $response->assertStatus(200);
    }
}
