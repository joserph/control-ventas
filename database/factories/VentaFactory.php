<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition()
    {
        return [
			'date' => $this->faker->name,
			'identification' => $this->faker->name,
			'client' => $this->faker->name,
			'validity_id' => $this->faker->name,
			'service_id' => $this->faker->name,
			'status' => $this->faker->name,
			'total' => $this->faker->name,
			'payment_form' => $this->faker->name,
			'bank' => $this->faker->name,
			'modality' => $this->faker->name,
			'partner_id' => $this->faker->name,
			'sub_total' => $this->faker->name,
			'discount' => $this->faker->name,
			'aditional_price' => $this->faker->name,
			'user_id' => $this->faker->name,
			'user_update' => $this->faker->name,
        ];
    }
}
