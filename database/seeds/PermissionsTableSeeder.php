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
        //patients
        DB::table('permissions')->insert([
            'name' => 'read patients',
            'guard_name' => 'web',
        ]);
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

        //users
        DB::table('permissions')->insert([
            'name' => 'read users',
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

        // investigations
        DB::table('permissions')->insert([
            'name' => 'read investigations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create investigations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit investigations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete investigations',
            'guard_name' => 'web',
        ]);

        // problems
        DB::table('permissions')->insert([
            'name' => 'read problems',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create problems',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit problems',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete problems',
            'guard_name' => 'web',
        ]);

        // examinations
        DB::table('permissions')->insert([
            'name' => 'read examinations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create examinations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit examinations',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete examinations',
            'guard_name' => 'web',
        ]);
    }
}
