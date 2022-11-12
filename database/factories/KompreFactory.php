<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class KompreFactory extends Factory
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
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'kartu_konfirmasi' => null,
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
            'keterangan' => 'keterangan',
        ];
    }
}
