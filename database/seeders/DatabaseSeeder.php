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
        User::factory()->create([
            'name' => 'Ryan Martin',
            'email' => 'ryan@nt4c.com',
            'password' => Hash::make('test1234'),
        ]);

        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'United Parcel Service',
                'employer_logo_url' => 'logos/united-parcel-service-300.webp',
            ]))
            ->create();

        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'Fedex Express',
                'employer_logo_url' => 'logos/fedex-express-300.webp',
            ]))
            ->create();

        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'Delta Air Lines',
                'employer_logo_url' => 'logos/delta-air-lines-300.webp',
            ]))
            ->create();

        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'Hawaiian Airlines',
                'employer_logo_url' => 'logos/hawaiian-airlines-300.webp',
            ]))
            ->create();

        Earning::factory()
            ->for(Report::factory()->state([
                'employer' => 'American Airlines',
                'employer_logo_url' => 'logos/american-airlines-300.webp',
            ]))
            ->create();

        $this->call([
            // AirlineSeeder::class,
        ]);
    }
}
