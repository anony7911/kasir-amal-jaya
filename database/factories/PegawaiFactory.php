<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition()
    {
        return [
			'nama_pegawai' => $this->faker->name,
			'alamat_pegawai' => $this->faker->name,
			'no_telp_pegawai' => $this->faker->name,
			'user_id' => $this->faker->name,
			'toko_id' => $this->faker->name,
        ];
    }
}
