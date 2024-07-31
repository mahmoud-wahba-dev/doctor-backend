<?php

namespace Database\Seeders;

use app\Enums\UserType;
use App\Models\Context;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ContextSeeder::class);

        $doctor = \App\Models\User::factory()->create([
            'email' => 'doctor@example.com',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'phone' => '0123456789',
            'password' => Hash::make('Password!'),
            'remember_token' => Str::random(10),
            'blocked' => false,
        ]);

        $doctor->contexts()->syncWithoutDetaching(Context::whereIn('name', [UserType::DOCTOR])->pluck('id')->toArray());
        $doctor->account()->create([
            'first_name' => 'Doctor',
            'last_name' => 'Doctor'
        ]);
    }
}
