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
            'name' => 'create patients',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit patients',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete patients',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create users',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit users',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete users',
            'guard_name' => 'web',
        ]);
    }
}
