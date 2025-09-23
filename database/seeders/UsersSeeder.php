<?php

namespace Database\Seeders;

use App\Models\Cashier;
use App\Models\Customer;
use App\Models\Photographer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        function createUser($name, $email, $password, $roles)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($roles);

            return $user;
        }

        function createCustomer($name, $email, $password, $roles)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
            ]);
            Customer::create([
                'user_id' => $user->id,
            ]);


            $user->assignRole($roles);

            return $user;
        }

        function createPhotographer($name, $email, $password, $roles, $type)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
            ]);
            Photographer::create([
                'user_id' => $user->id,
                'type' => $type,
            ]);


            $user->assignRole($roles);

            return $user;
        }

        function createCashier($name, $email, $password, $roles)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
            ]);
            Cashier::create([
                'user_id' => $user->id,
            ]);


            $user->assignRole($roles);

            return $user;
        }
        createUser('Owner', 'owner@artsbysahara.com', 'AdminAdmin', 'owner');
        createCustomer('Intan', 'intann@gmail.com', '12345678', 'customer');
        createCustomer('Dea', 'dea@gmail.com', '12345678', 'customer');
        createPhotographer('Tegar', 'tegar@gmail.com', '12345678', 'photographer', 1);
        createPhotographer('Iqmal', 'iqmal@gmail.com', '12345678', 'photographer', 1);
        createPhotographer('Megan', 'megan@gmail.com', '12345678', 'photographer', 1);
        createCashier('Opik', 'opik@gmail.com', '12345678', 'cashier');
        createCashier('Patar', 'patar@gmail.com', '12345678', 'cashier');
    }
}
