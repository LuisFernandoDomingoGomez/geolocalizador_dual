<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            //Operacions sobre tabla blogs
            'ver-blog',
            'crear-blog',
            'editar-blog',
            'borrar-blog',

            //Operacions sobre tabla empresas
            'ver-empresa',
            'crear-empresa',
            'editar-empresa',
            'borrar-empresa'
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}