<?php

namespace Database\Factories;

use App\Models\Retrospective;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetrospectiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Retrospective::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id');
        $user_name = User::all()->pluck('name');
        $project = Project::all()->pluck('id');
        return [
            'description' => $this->faker->realText(200),
            'type' => $this->faker->randomElement(['positive', 'negative']),
            'user_id' => $this->faker->randomElement($user),
            'user_name' => $this->faker->randomElement($user_name),
            'project_id' => $this->faker->randomElement($project),
        ];
    }
}
