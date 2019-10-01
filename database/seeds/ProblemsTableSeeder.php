<?php

use Illuminate\Database\Seeder;
use App\Problem;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Problem::class, 3)->create();
    }
}
