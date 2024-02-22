<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    
    static $rules = [
        'name' => 'required',
    ];

    protected $perPage = 20;
    protected $fillable = ['name'];

    // Relacion con Encuestas
    public function encuestas()
    {
        return $this->hasMany('App\Models\Encuesta', 'encuesta_id', 'id');
    }
}