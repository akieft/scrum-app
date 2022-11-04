<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id');
        $owner_name = User::all()->pluck('name');
        $scrum_name = User::all()->pluck('name');
        return [
            'name' => $this->faker->realText(20),
            'description' => $this->faker->realText(200),
            'end_date' => $this->faker->date(),
            'owner_name' => $this->faker->randomElement($owner_name),
            'scrum_name' => $this->faker->randomElement($scrum_name),
            'product_owner' => $this->faker->randomElement($user),
            'scrum_master' => $this->faker->randomElement($user),
        ];
    }
}
