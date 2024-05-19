<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'user_id' => 100,
            'nama_depan' => $this->faker->name,
            'nama_belakang' => '',
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'alamat' => $this->faker->address,
        ];
    }
}
