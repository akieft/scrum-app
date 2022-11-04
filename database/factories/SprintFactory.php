<?php

namespace Database\Factories;

use App\Models\Sprint;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SprintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sprint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $project = DB::table('projects')->pluck('id');
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->Sentence(20),
            'meeting_date' => $this->faker->date(),
            'project_id' => $this->faker->randomElement($project),
        ];
    }
}
