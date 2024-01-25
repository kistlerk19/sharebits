<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'recipient' => $this->faker->email,
            'send_date' => $this->faker->date('Y-m-d', '+30 days'),
            'is_published' => $this->faker->boolean,
            'heart_count' => $this->faker->numberBetween(0, 200),
        ];
    }
}
