<?php

namespace Database\Factories;

use App\Models\Qrcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class QrcodeFactory extends Factory
{
    protected $model = Qrcode::class;

    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'data' => $this->faker->text(50),
        ];
    }
}
