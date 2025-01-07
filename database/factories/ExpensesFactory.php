<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(5), // Unique ID
            'name' => $this->faker->name, // Random name
            'description' => $this->faker->randomElement(['Fines', 'Class Fund', 'Organizational Fee', 'CSC Fee']), // Example descriptions
            'amount' => $this->faker->randomFloat(2, 10, 1000), // Random monetary amount (2 decimal points)
            'date' => $this->faker->date('Y-m-d'), // Random date in 'YYYY-MM-DD' format
        ];
    }
}
