<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class RaceFactory
 *
 * @package Database\Factories
 */
class RaceFactory extends Factory
{
    protected $model = Race::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->userName() . $this->faker->userName();

        return [
            'name' => $name,
            'code' => Str::slug($name),
            'description' => $this->faker->text(),
        ];
    }
}
