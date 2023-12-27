<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'lecturer_id' => 3,
            'semester' => 'Ganjil',
            'academic_year' => '2022/2023',
            'sks'=>3,
            'code'=> strtoupper(fake()->toUpper(Str::random(6))),
            'description' => fake()->text(),
        ];
    }
}
