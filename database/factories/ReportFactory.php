<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Airline;
use App\Enums\ReportFleets;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'wage_year' => '2023',
            'longevity' => Number::ordinal($this->faker->numberBetween(1,12)) . ' Year',
            'employer' => 'Atlas Air',
            'employer_logo_url' => 'logos/atlas-air-300.webp',
            'fleet' => collect(ReportFleets::cases())->shuffle()->first()->name,
            'seat' => $this->faker->boolean(50) ? 'CA' : 'FO',
        ];
    }
}
