<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=>fake()->jobTitle(),
            "salary"=>fake()->randomElement(['50000 USD','60000 USD','70000USD']),
            "employer_id"=>Employer::factory(),
            "location"=>fake()->randomElement(['On Site','Remotly']),
            "schedule"=>fake()->randomElement(['Full Time','Part Time']),
            "url" =>fake()->url,
            "featured"=>fake()->boolean
        ];
    }
}
