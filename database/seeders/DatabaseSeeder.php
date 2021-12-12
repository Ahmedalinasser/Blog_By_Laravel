<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Database\Factories\UserFactory;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(20)
            ->has(Post::factory()
            ->count(2))
            ->create();

    }



}
