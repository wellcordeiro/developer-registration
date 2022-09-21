<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
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
            'name' => $this->faker->sentence(11),
            'level_id' => $this->faker->numberBetween(1, 10),
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birthdate' => $this->faker->date(),
            'hobby' => $this->faker->randomElement(['Reading', 'Writing', 'Coding', 'Gaming', 'Watching TV', 'Listening to Music', 'Playing Sports'])
        ];
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function generateUniqueDeveloperWithLevelId($levelId): array
    {
        return [
            'name' => $this->faker->sentence(11),
            'level_id' => $levelId,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birthdate' => $this->faker->date(),
            'hobby' => $this->faker->randomElement(['Reading', 'Writing', 'Coding', 'Gaming', 'Watching TV', 'Listening to Music', 'Playing Sports'])
        ];
    }

    public function developerWithoutLevelId()
    {
        return [
            'name' => $this->faker->sentence(11),
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birthdate' => $this->faker->date(),
            'hobby' => $this->faker->randomElement(['Reading', 'Writing', 'Coding', 'Gaming', 'Watching TV', 'Listening to Music', 'Playing Sports'])
        ];
    }
}
