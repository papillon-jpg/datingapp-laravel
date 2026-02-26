<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilFactory extends Factory
{
    protected $model = Profil::class;

    public function definition(): array
    {
        $spol = $this->faker->randomElement(['musko', 'zensko']);

        return [
            'ime' => $this->faker->firstName($spol === 'musko' ? 'male' : 'female'),
            'prezime' => $this->faker->lastName(),
            'datum_rodjenja' => $this->faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'spol' => $spol,
            'grad' => $this->faker->city(),
            'opis' => $this->faker->sentence(12),

            'zainteresovan_za' => $this->faker->randomElement(['musko','zensko','oba']),
            'min_godine' => $this->faker->numberBetween(18, 30),
            'max_godine' => $this->faker->numberBetween(31, 50),

            // profilna_slika ostavi null za seed (da ne komplikujemo storage)
            'profilna_slika' => null,
        ];
    }
}