<?php

use App\User;
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
        $user = User::create([
            'first_name'            => 'super',
            'last_name'             => 'admin',
            'email'                 => 'super_admin@app.com',
            'password'              => bcrypt('yahya')
        ]);

        $user->attachRole('super_admin');
    }
}
