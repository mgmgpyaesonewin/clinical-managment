<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pyae Sone',
            'address' => '38, Padather Street, Maynigone, SanChaung',
            'dob' => '14/12/1995',
            'nrc' => '12/SaKhaNa(N)082719',
            'phone' => '09796874359',
            'organization' => 'Group of Hospital',
            'gender' => 'male',
            'email' => 'pyae@gmail.com',
            'password' => bcrypt('abcd1234')
        ]);
    }
}
