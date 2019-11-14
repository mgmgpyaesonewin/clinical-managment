<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Appointment;
use App\Observers\AppointmentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public $data=0;
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Appointment::observe(AppointmentObserver::class);
    }
}
