<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{

    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->words(5, true);
        $slug = Str::slug($title);

        return [
            'category_id' => Category::whereNotNull('parent_id')->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->words(75, true),
            'pricing' => $this->faker->words(20, true),
        ];
    }
}
