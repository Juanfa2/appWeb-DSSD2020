<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email_date_verification = Carbon::create(2000, 1, 25, 13, 0, 0);

        DB::table('users')->insert([
            'name' => 'Lihuel Pablo', 'email' => 'lihueamoroso@gmail.com', 'email_verified_at' => $email_date_verification, 'password' => bcrypt("1234567890"), 'rol' => 'Jefe'
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Manuel', 'email' => 'juanmaotto9@gmail.com', 'email_verified_at' => $email_date_verification, 'password' => bcrypt("1234567890"), 'rol' => 'Responsable'
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Francisco', 'email' => 'juanfranciso11@gmail.com', 'email_verified_at' => $email_date_verification, 'password' => bcrypt("1234567890"), 'rol' => 'Responsable'
        ]);
    }
}
