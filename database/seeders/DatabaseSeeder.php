<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Report;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Earning;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'United Parcel Service',
            ]))
            ->create();
    }
}
