<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::truncate();

        $users = array(
            [
                'id' => 1,
                'full_name' => 'Super Admin',
                'email' => 'admin@kickstart.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 2,
                'full_name' => 'Shakil Momin',
                'email' => 'shakil.momin@synergates.com',
                'password' => Hash::make('password'),

            ],
            [
                'id' => 3,
                'full_name' => 'Ali Shan',
                'email' => 'alishan.amin@synergates.com',
                'password' => Hash::make('password'),

            ],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            User::insert($user);
        }

        Model::reguard();
    }
}
