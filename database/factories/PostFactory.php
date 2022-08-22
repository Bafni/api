<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'seo_keywords' => $this->faker->words(5,5),
            'slug' => Str::random(10).'/'.Str::random(10),
            'small_description' => $this->faker->sentence(10),
            'description' => $this->faker->text(500)
        ];
    }
}
