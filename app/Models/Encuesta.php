<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    use HasFactory;

    protected $perPage = 20;

    protected $fillable = [
        'user_id', 
        'empresa_id',
        'latitud',
        'longitud',
    ];

    // Relacion con Empresas
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }

    // Relacion con Users
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
