<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemproFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nim' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'judul_sempro' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => $this->faker->word(10),
            'nota_kaprodi' => null,
            'berkas_sempro' => null,
            'status' => null,
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
            'keterangan' => 'keterangan',
        ];
    }
}
