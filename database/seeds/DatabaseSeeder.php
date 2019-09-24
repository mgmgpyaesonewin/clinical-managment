<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(ConsultationsTableSeeder::class);
        $this->call(ProblemsTableSeeder::class);
        $this->call(InvestigationsTableSeeder::class);
    }
}
