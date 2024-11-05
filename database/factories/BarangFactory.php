<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition()
    {
        return [
			'kode_barang' => $this->faker->name,
			'nama_barang' => $this->faker->name,
			'deskripsi_barang' => $this->faker->name,
        ];
    }
}
