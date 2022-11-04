<?php

namespace Database\Factories;

use App\Models\UserProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class UserProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = DB::table('users')->pluck('id');
        $project = DB::table('projects')->pluck('id');
        return [
            'user_id' => $this->faker->randomElement($user),
            'project_id' => $this->faker->randomElement($project),
        ];
    }
}
