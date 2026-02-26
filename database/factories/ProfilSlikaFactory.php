<?php

namespace Database\Factories;

use App\Models\ProfilSlika;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilSlika>
 */
class ProfilSlikaFactory extends Factory
{
    protected $model = ProfilSlika::class;

    public function definition(): array
{
    return [
        'path' => 'profili/demo'.rand(1,5).'.jpg'
    ];
}
}




