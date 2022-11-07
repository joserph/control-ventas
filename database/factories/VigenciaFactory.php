<?php

namespace Database\Factories;

use App\Models\Vigencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VigenciaFactory extends Factory
{
    protected $model = Vigencia::class;

    public function definition()
    {
        return [
			'type' => $this->faker->name,
			'years' => $this->faker->name,
			'price_total' => $this->faker->name,
			'price_partner' => $this->faker->name,
			'user_id' => $this->faker->name,
			'user_update' => $this->faker->name,
        ];
    }
}
