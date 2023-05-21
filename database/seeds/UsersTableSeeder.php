<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'phone' => '9876543210',
            'sex' => 'male',
            'dob' => '1997-01-01',
            'acc_type' => 'normal',
            'proof_type' => 'adhaar',
            'proof_id' => '4348343894398',
            'address' => '2 ABC street, Chennai, 848584',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
