<?php

namespace Database\Factories;

use App\Models\Toko;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TokoFactory extends Factory
{
    protected $model = Toko::class;

    public function definition()
    {
        return [
			'no_toko' => $this->faker->name,
			'alamat_toko' => $this->faker->name,
			'kategori' => $this->faker->name,
			'jumlah_pegawai' => $this->faker->name,
        ];
    }
}
