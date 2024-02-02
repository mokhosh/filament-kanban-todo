<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'urgent' => fake()->randomElement([true, false]),
            'progress' => fake()->numberBetween(0, 100),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(TaskStatus::cases()),
        ];
    }
}
