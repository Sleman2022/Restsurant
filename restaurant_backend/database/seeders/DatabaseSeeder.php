<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "admin",
            "role" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            "name" => "restaurant admin",
            "role" => "restaurant admin",
            "email" => "restaurant_admin@restaurant_admin.com",
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            "name" => "user",
            "role" => "user",
            "email" => "user@user.com",
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //
        Menu::create([
            "discount" => null,
            "name" => 'main',
        ]);
    }
}
