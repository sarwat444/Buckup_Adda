<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mangement>
 */
class MangementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' =>  'كليه الحاسبات جامعه ينها',
            'top_mangement' => 0 ,
            'kheta_id' => 1
        ];
    }
}
