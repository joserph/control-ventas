<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'user_id' => $this->faker->name,
			'user_update' => $this->faker->name,
        ];
    }
}
