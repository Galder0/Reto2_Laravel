<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition()
    {
        // TODOO apply es_ES language
        // $this->faker->locale('es_ES');
        
        return [
            'name' => $this->faker->name,
            'surnames' => $this->faker->lastName,
            'DNI' => $this->faker->unique()->randomNumber(8),
            'email' => $this->faker->unique()->safeEmail,
            'direction' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'fct_dual' => $this->faker->boolean,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('Elorrieta00'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}