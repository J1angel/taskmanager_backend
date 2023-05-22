<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Test Title Task Todo',
            'description' => 'Test Description Task Todo',
            'due_date' => date('Y-m-d'),
            'created_by' => User::all()->random()->id,
        ];
    }
}
