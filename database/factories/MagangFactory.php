<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class MagangFactory extends Factory
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
            'alamat' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'no_pembayaran' => $this->faker->word(10),
            'instansi_magang' => $this->faker->word(10),
            'pimpinan_instansi' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'lembar_persetujuan' => null,
            'keterangan' => 'keterangan',
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
        ];
    }
}
