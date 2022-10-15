<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TahunAjaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tahun' => $this->faker->year(now()),
            'semester' => 1,
            'is_active' => 0
        ];
    }
}
