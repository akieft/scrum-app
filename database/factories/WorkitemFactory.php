<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workitem;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class WorkitemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workitem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id');
        $assigned_name = User::all()->pluck('name');
        $project = Project::all()->pluck('id');
        return [
            'title' => $this->faker->word(),
            'type' => $this->faker->randomElement(['task', 'backlog']),
            'effort' => $this->faker->randomFloat(2, 0.1, 10),
            'created_at' => now(),
            'status' => $this->faker->randomElement(['new', 'to-do', 'doing', 'done']),
            'assigned_name' => $this->faker->randomElement($assigned_name),
            'assigned_to' => $this->faker->randomElement($user),
            'project_id' => $this->faker->randomElement($project),
        ];
    }
}
