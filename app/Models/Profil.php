<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\ProfilSlika;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getGodineAttribute()
        {
            return $this->datum_rodjenja
                ? Carbon::parse($this->datum_rodjenja)->age
                : null;
        }

    public function slike()
{
    return $this->hasMany(ProfilSlika::class, 'profil_id');
}

    protected $fillable = [
    'ime','prezime','datum_rodjenja','spol','grad','opis','profilna_slika',
    'zainteresovan_za','min_godine','max_godine','user_id'
];
}
