<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'article_id' => function () {
                return Article::all()->random();
            },
            'comment' => $this->faker->paragraph,
        ];
    }
}
