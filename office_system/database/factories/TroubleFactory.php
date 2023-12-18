<?php

namespace Database\Factories;

use App\Models\Trouble;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trouble>
 */
class TroubleFactory extends Factory
{
    protected $model = Trouble::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'function' => $this->faker->randomElement([1, 2, 3, 4, 5, 99]),
            'occurred_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'phenomenon' => $this->faker->paragraph(3),
            'reproduction_steps' => $this->faker->paragraph(4),
            'cause' => $this->faker->optional()->paragraph(3),
            'cause_type' => $this->faker->optional()->randomElement([1, 2, 3, 4, 5, 6, 7, 99]),
            'cause_process' => $this->faker->optional()->randomElement([1, 2, 3, 4, 5, 6, 7, 99]),
            'corresponding_user_id' => $this->faker->optional()->numberBetween(1, 30),
            'corresponding_limit' => $this->faker->optional()->date(),
            'priority' => $this->faker->numberBetween(1, 4),
            'remarks' => $this->faker->optional()->paragraph(3),
            'status' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 99]),
            'register_type' => $this->faker->randomElement([1, 2]),
            'create_user' => $this->faker->numberBetween(1, 30),
            'update_user' => $this->faker->optional()->numberBetween(1, 30),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
