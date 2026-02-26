<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'profil_id' => Profil::inRandomOrder()->value('id'),
        ];
    }
}