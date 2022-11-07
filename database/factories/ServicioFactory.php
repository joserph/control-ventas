<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServicioFactory extends Factory
{
    protected $model = Servicio::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'user_id' => $this->faker->name,
			'user_update' => $this->faker->name,
        ];
    }
}
