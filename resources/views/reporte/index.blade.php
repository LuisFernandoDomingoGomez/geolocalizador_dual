@extends('layouts.app')

@section('template_title')
    Reporte
@endsection

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">CECyTEM</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Reporte</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
    </div>
    <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <span id="card_title">
                                    {{ __('Registros') }}
                                </span>

                                <div class="float-right">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-file"></i> Reportes
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('reporte.pdf') }}"><i class="fas fa-file-pdf"></i> Reporte general</a>
                                            <a class="dropdown-item" href="{{ route('reporte.export') }}"><i class="fas fa-file-excel"></i> Reporte por alumno</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form class="d-flex" action="{{ route('reportes.index') }}" method="GET">
                                <input class="form-control me-2" type="text" name="search" placeholder="Búsqueda" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Latitud</th>
                                            <th>Longitud</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($encuestas as $encuesta)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $encuesta->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $encuesta->created_at->format('h:i A') }}</td>
                                                <td>{{ $encuesta->user->name }}</td>
                                                <td>{{ $encuesta->empresa->name }}</td>
                                                <td>{{ $encuesta->latitud }}</td>
                                                <td>{{ $encuesta->longitud }}</td>
                                                <td>
                                                    <form action="{{ route('encuestas.destroy',$encuesta->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('encuestas.show',$encuesta->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $encuestas->links() !!}
                </div>
            </div>
        </div>
    @endsection
</div>