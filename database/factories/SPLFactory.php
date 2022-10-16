<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SPLFactory extends Factory
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
            'foto_ktp' => null,
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'keterangan' => 'keterangan',
        ];
    }
}
