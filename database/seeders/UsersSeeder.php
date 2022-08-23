<?php

namespace Database\Seeders;

use App\Models\Coin;
use App\Models\JobVacancy;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create()->each(function ($user) {

            // Seed the relation with coins count (5 as max value by default)
            $coin = Coin::factory()->make();
            $user->coin()->save($coin);

            // Seed the relation with job vacancies (1 or 2 per user)
            $job_vacancy = JobVacancy::factory(rand(1,2))->make();
            $user->jobVacancies()->saveMany($job_vacancy);

            // Seed the relation with likes
            $like = Like::factory()->make();
            $user->liked()->save($like);
        });
    }
}
