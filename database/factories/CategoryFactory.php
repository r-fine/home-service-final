<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $title = $this->faker->words(3, true);
        $slug = Str::slug($title);

        return [
            'parent_id' => Category::whereNull('parent_id')->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->words(50, true),
        ];
    }
}
