<?php

namespace Database\Factories;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'surat_id' => Surat::inRandomOrder()->first()?->id ?? Surat::factory(),
            'ayat_halaman' => $this->faker->bothify('Ayat ##, Halaman ##'),
            'tanggal' => $this->faker->date(),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}
