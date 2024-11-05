<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
			'nama_supplier' => $this->faker->name,
			'alamat_supplier' => $this->faker->name,
			'no_telp_supplier' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
