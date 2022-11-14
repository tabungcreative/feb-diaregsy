<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class MengulangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nim' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => $this->faker->word(10),
            'khs' => null,
            'keterangan' => 'keterangan',
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
        ];
    }
}
