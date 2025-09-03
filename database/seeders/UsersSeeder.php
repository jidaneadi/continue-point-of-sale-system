<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        function createUser($name, $email, $password, $roles) {
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

        createUser('Owner', 'owner@artsbysahara.com', 'AdminAdmin', 'owner'); 
    }
}
