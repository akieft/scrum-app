<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Standard data
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['Stephan Hoeksema', 'Stephan@hotmail.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);

        \App\Models\User::factory(10)->create();
        \App\Models\Project::factory(10)->create();
        \App\Models\Workitem::factory(10)->create();
        \App\Models\Sprint::factory(10)->create();
        \App\Models\Retrospective::factory(10)->create();
        \App\Models\UserProject::factory(10)->create();
        \App\Models\SprintReview::factory(10)->create();
    }
}
