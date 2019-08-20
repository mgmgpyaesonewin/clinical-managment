<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'create patients | edit patients | delete patients',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create users | edit users | delete users',
            'guard_name' => 'web',
        ]);
    }
}
