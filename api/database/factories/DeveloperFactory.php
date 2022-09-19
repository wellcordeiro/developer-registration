<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'  => $this->faker->unique()->randomNumber(3),
            'name' => $this->faker->sentence(11),
            'level_id' => $this->faker->numberBetween(1, 5),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birthdate' => $this->faker->date(),
            'hobby' => $this->faker->randomElement(['Reading', 'Writing', 'Coding', 'Gaming', 'Watching TV', 'Listening to Music', 'Playing Sports'])
        ];
    }
}
