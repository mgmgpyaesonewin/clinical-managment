<?php

namespace Tests\Feature;

use App\Patient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Carbon\Carbon;
use App\Appointment;
use App\SessionInterval;

class ReservationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function a_patient_can_book_a_doctor()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $doctor = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $faker = \Faker\Factory::create(); 
        $tomorrow =  Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+01 days')->getTimestamp());
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $tomorrow)->addHours(3);
        $this->actingAs($user, 'api')->json('POST','/api/sessions', [
            'date' => $tomorrow->format('d-m-Y'),
            'start_time' => "12:00",
            'end_time' => "13:00",
            'interval' => 15,
            'intervals' => 
                array (
                  0 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:00',
                  ),
                  1 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:15',
                  ),
                  2 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:30',
                  ),
                  3 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:45',
                  ),
                ),
            'doctor_id' => $doctor->id,
            'cmt' => $faker->text
        ]);
        $sessions = $this->actingAs($user, 'api')->get('/api/sessions?id='.$doctor->id)->getOriginalContent();
        $selected_session_id = $sessions->first()->id;
        $selected_session_interval_id = $sessions->first()->slots->first()->id;
        $response = $this->actingAs($user, 'api')->post('/api/appointments', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'session_id' => $selected_session_id,
            'session_interval_id' => $selected_session_interval_id
        ]);
        $response->assertStatus(201);
        $appointment = Appointment::first()->get();
        $this->assertTrue($appointment->contains('id', 1));
        $session_interval = SessionInterval::where('id',$selected_session_interval_id)->first()->get();
        $this->assertTrue($session_interval->contains('id', 1));
    }

    /** @test **/
    public function get_all_slots_via_a_doctor_on_a_date()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $doctor = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $faker = \Faker\Factory::create(); 
        $tomorrow =  Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+01 days')->getTimestamp());
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $tomorrow)->addHours(3);
        $this->actingAs($user, 'api')->json('POST','/api/sessions', [
            'date' => $tomorrow->format('d-m-Y'),
            'start_time' => "12:00",
            'end_time' => "13:00",
            'interval' => 15,
            'intervals' => 
                array (
                  0 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:00',
                  ),
                  1 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:15',
                  ),
                  2 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:30',
                  ),
                  3 => 
                  array (
                    'booked' => false,
                    'date' => '2019-11-21',
                    'doctor_id' => 2,
                    'time' => '12:45',
                  ),
                ),
            'doctor_id' => $doctor->id,
            'cmt' => $faker->text
        ]);
        $sessions = $this->actingAs($user, 'api')->get('/api/sessions?id='.$doctor->id)->getOriginalContent();
    }
}
