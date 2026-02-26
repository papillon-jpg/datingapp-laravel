<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dislike extends Model
{
use HasFactory;    
protected $fillable = ['user_id', 'profil_id'];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}