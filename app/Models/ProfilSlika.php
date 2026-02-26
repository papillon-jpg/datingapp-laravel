<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilSlika extends Model
{

    use HasFactory;
protected $table = 'profil_slikes';     
protected $fillable = ['profil_id', 'path'];
    

    public function profil()
{
    return $this->belongsTo(\App\Models\Profil::class);
}
}