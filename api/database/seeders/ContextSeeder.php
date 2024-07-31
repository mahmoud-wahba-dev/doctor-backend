<?php

namespace Database\Seeders;

use app\Enums\UserType;
use App\Models\Context;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contexts = [
            [
                'name' => UserType::DOCTOR,
            ],
            [
                'name' => UserType::PATIENT,
            ]
        ];

        collect($contexts)->each(fn($context) => Context::query()->firstOrCreate(['name' => $context['name']],$context));
    }
}
