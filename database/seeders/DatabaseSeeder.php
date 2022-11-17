<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Post::factory(20)->create();

        //Category::factory(6)->create();

        $categories = array ('Web Design', 'HTML', 'Freebies', 'JavaScript', 'CSS', 'Tutorials');
        foreach($categories as $category) {
            Category::factory()->create([
                'name' => $category,
            ]);

        }

        Post::all()->each(function ($post) {
            $post->categories()->attach(
                Category::all()->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
