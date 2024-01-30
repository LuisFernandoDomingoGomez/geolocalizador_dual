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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = new Empresa();
        return view('empresa.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empresa::$rules);

        $empresa = Empresa::create($request->all());

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