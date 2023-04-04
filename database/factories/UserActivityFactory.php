<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserActivity>
 */
class UserActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'activity_id' => $this->faker->randomElement(Activity::all())['id'],
            'point_in_time' => fake()->time(),
            'speed' => fake()->randomFloat(3, 0, 500),
        ];
    }
}
