<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Earning>
 */
class EarningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_id' => Report::factory(),
            'flight_pay' => $this->faker->numberBetween(500, 400000),
            'profit_sharing' => $this->faker->numberBetween(500, 60000),
            'employer_retirement_contribution' => $this->faker->numberBetween(500, 20000),
            'employer_health_savings_contribution' => $this->faker->numberBetween(500, 1000),
            'days_worked' => $this->faker->numberBetween(50, 300),
            'block_hours_flown' => $this->faker->numberBetween(50, 1000),
            'is_commuter' => $this->faker->boolean(50) ? true : false,
            'report_comment' => $this->faker->text(200),
        ];
    }
}
