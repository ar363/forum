<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_by' => User::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true),
            'tags' => $this->faker->words(4),
            'category_id' => Category::all()->random()->id, // make sure to run CategorySeeder before this
        ];
    }
}
