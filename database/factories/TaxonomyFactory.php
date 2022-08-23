<?php

namespace Database\Factories;

use App\Models\Taxonomy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxonomyFactory extends Factory
{
    protected $model = Taxonomy::class;
    public function definition()
    {
        return [
            'user_id' => User::get()->random()->id,
            'taxonomy_type' => $this->faker->sentence,
        ];
    }
}
