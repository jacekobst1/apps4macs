<?php

namespace Database\Factories;

use App\Enums\AppStatus;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<App>
 */
class AppFactory extends Factory
{
    protected $model = App::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => AppStatus::Accepted,
            'url' => fake()->url(),
            'title' => fake()->streetName(),
            'sentence' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'is_paid' => fake()->boolean(),
        ];
    }
}
