<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class BimbinganSkripsiFactory extends Factory
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
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => $this->faker->word(10),
            'keterangan' => 'keterangan',
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id
        ];
    }
}
