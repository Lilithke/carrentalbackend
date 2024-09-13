<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $CarIds = Car::all()->pluck("id");
        $startDate = fake()->dateTimeBetween('-1 year')->format("Y-m-d");
        $endDate = date("Y-m-d",strtotime($startDate."+1 week"));

        return [
            "car_id" => fake()->randomElement($CarIds),
            "start_date" =>$startDate,
            "end_date" =>$endDate,
        ];
    }
}
