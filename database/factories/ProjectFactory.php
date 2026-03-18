<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projects = config('projects');
        $title = array_rand($projects, 1);
        $project = $projects[$title];


        return [
            //
            "name" => $title,
            "description" => $project,
            "hours" => $this->faker->numberBetween(10, 200),
            "start_date" => $this->faker->date(),
            "image_path" => null,
        ];
    }
}
