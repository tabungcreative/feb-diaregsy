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
            'no_pembayaran' => $this->faker->word(10),
            'judul' => $this->faker->word(10),
            'email' => $this->faker->email,
            'no_hp' => $this->faker->phoneNumber,
            'nota_dinas_kaprodi' => null,
            'berkas_seminar' => null,
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
            'keterangan' => 'keterangan',
        ];
    }
}
