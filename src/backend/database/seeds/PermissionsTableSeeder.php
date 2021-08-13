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
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create patients',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit patients',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete patients',
            'guard_name' => 'api',
        ]);

        //users
        DB::table('permissions')->insert([
            'name' => 'read users',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create users',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit users',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete users',
            'guard_name' => 'api',
        ]);

        // investigations
        DB::table('permissions')->insert([
            'name' => 'read investigations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create investigations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit investigations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete investigations',
            'guard_name' => 'api',
        ]);

        // problems
        DB::table('permissions')->insert([
            'name' => 'read problems',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create problems',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit problems',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete problems',
            'guard_name' => 'api',
        ]);

         // medications
        DB::table('permissions')->insert([
            'name' => 'read medications',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create medications',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit medications',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete medications',
            'guard_name' => 'api',
        ]);

        // examinations
        DB::table('permissions')->insert([
            'name' => 'read examinations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create examinations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit examinations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete examinations',
            'guard_name' => 'api',
        ]);

         // consultations
        DB::table('permissions')->insert([
            'name' => 'read consultations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create consultations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit consultations',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete consultations',
            'guard_name' => 'api',
        ]);
    }
}
