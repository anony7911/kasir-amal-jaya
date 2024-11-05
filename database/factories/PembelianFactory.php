<?php

namespace Database\Factories;

use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PembelianFactory extends Factory
{
    protected $model = Pembelian::class;

    public function definition()
    {
        return [
			'jumlah_barang' => $this->faker->name,
			'total_harga' => $this->faker->name,
			'barang_id' => $this->faker->name,
			'supplier_id' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
