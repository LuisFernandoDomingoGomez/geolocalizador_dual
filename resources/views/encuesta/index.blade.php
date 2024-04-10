@extends('layouts.app')

@section('template_title')
    Encuesta
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
                    <li class="breadcrumb-item"><a href="{{ route('encuestas.index') }}">Encuestas</a></li>
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
                                            <i class="fas fa-file"></i> Exportar
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('encuesta.pdf') }}"><i class="fas fa-file-pdf"></i> PDF</a>
                                            <a class="dropdown-item" href="{{ route('encuesta.export') }}"><i class="fas fa-file-excel"></i> Excel</a>
                                        </div>
                                    </div>

                                    <a href="{{ route('encuestas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                    </a>
                                </div>
                            </div>
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
                                                <td>{{ $encuesta->created_at->isoFormat('D [de] MMMM [de] Y') }}</td>
                                                <td>{{ $encuesta->created_at->format('h:i A') }}</td>
                                                <td>{{ $encuesta->user->name }}</td>
                                                <td>{{ $encuesta->empresa->name }}</td>
                                                <td>{{ $encuesta->latitud }}</td>
                                                <td>{{ $encuesta->longitud }}</td>
                                                <td>
                                                    <form action="{{ route('encuestas.destroy',$encuesta->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
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