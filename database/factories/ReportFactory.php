<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Airline;
use App\Enums\ReportFleets;
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
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'wage_year' => '2023',
            'airline_slug' => 'atlas-air',
            'fleet' => collect(ReportFleets::cases())->shuffle()->first()->name,
            'seat' => $this->faker->boolean(50) ? 'CA' : 'FO',
        ];
    }
}
