<?php

namespace Database\Factories;

use App\Models\PostModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PostModel::class;
    
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'author' => $this->faker->name() ,
            'slug'  => Str::slug($title). '-'. Str::random(5),
            'body' => $this->faker->paragraphs(5,true),
            'category' => $this->faker->randomElement([
                'Teknologi',
                'Pemrograman',
                'Berita',
                'Tips',
                'Tutorial'
            ])
        ];
    }
}
