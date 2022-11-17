<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'    => $this->faker->sentence(4),
            //'author' => $this->faker->name(),
            'user_id'  => User::inRandomOrder()->first()->id,
            'lead'     => $this->faker->sentence(10),
            'content'  => $this->faker->text(600),
            'image'    => $this->faker->imageUrl($width=900, $height= 400),
        ];
    }
}