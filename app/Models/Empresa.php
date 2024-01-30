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
}