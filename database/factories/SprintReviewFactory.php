<?php

namespace Database\Factories;

use App\Models\SprintReview;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SprintReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SprintReview::class;

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
            'description' => $this->faker->Realtext(50),
            'meeting_date' => $this->faker->date(),
            'project_id' => $this->faker->randomElement($project),
        ];
    }
}
