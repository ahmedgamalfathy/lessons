<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LessonTag;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LesssonTag>
 */
class LessonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'lesson_id'=>fake()->numberBetween(1,100),
           'tag_id'=>fake()->numberBetween(1,10),
        ];
    }
}
