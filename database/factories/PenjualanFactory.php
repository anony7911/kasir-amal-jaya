<?php

namespace Database\Factories;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PenjualanFactory extends Factory
{
    protected $model = Penjualan::class;

    public function definition()
    {
        return [
			'jumlah_barang' => $this->faker->name,
			'total_harga' => $this->faker->name,
			'barang_id' => $this->faker->name,
			'toko_id' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
