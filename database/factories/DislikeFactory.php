<?php

namespace Database\Factories;

use App\Models\Dislike;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

class DislikeFactory extends Factory
{
    protected $model = Dislike::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'profil_id' => Profil::inRandomOrder()->value('id'),
        ];
    }
}
