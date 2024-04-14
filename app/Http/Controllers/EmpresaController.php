<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-empresa|crear-empresa|editar-empresa|borrar-empresa')->only('index');
        $this->middleware('permission:crear-empresa', ['only' => ['create','store']]);
        $this->middleware('permission:editar-empresa', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-empresa', ['only' => ['destroy']]);
    }

    public function index()
    {
        $empresas = Empresa::paginate();

        return view('empresa.index', compact('empresas'))
            ->with('i', (request()->input('page', 1) - 1) * $empresas->perPage());
    }

    public function create()
    {
        $empresa = new Empresa();
        return view('empresa.create', compact('empresa'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear una nueva instancia de Empresa
        $empresa = new Empresa();
        $empresa->name = $request->input('name'); // Asignar el nombre

        $imagen = $request->file('imagen');
        $imagenNombre = $imagen->getClientOriginalName();
        $imagen->storeAs('img_empresas', $imagenNombre, 'public'); // Guardar en la carpeta "img_empresas" en el disco público

        // Guardar la imagen en la carpeta "img_empresas"
        $imagen->move(public_path('img_empresas'), $imagenNombre);
        $empresa->imagen = 'img_empresas/' . $imagenNombre;

        $empresa->save();
    
        return redirect()->route('empresas.index')
            ->with('success', 'Empresa creada con exito.');
    }

    public function edit($id)
    {
        $empresa = Empresa::find($id);

        return view('empresa.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        request()->validate(Empresa::$rules);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa actualizada con exito');
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id)->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa eliminada con exito');
    }
}