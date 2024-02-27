@extends('layouts.app')

@section('template_title')
    Create Encuesta
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
                        <li class="breadcrumb-item"><a href="{{ route('encuestas.index') }}">Encuesta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalles</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
    </div>
    <br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles del registro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reportes.index') }}"> Atrás</a>
                        </div>
                    </div>
                    <div class="content container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Lista de datos del registro -->
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Usuario:</strong> {{ $encuesta->user->name }}</li>
                                    <li class="list-group-item"><strong>Empresa:</strong> {{ $encuesta->empresa->name }}</li>
                                    <li class="list-group-item"><strong>Fecha:</strong> {{ $encuesta->created_at->format('Y-m-d') }}</li>
                                    <li class="list-group-item"><strong>Hora:</strong> {{ $encuesta->created_at->toTimeString() }}</li>
                                    <li class="list-group-item"><strong>Latitud:</strong> {{ $encuesta->latitud }}</li>
                                    <li class="list-group-item"><strong>Longitud:</strong> {{ $encuesta->longitud }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <!-- Mapa de OpenStreetMap -->
                                <div id="map" style="height: 400px;"></div>
                                <p>Latitud: {{ $encuesta->latitud }}</p>
                                <p>Longitud: {{ $encuesta->longitud }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    </div>
@endsection


@section('scripts')
    @parent
    <!-- Incluye Leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Crea un mapa Leaflet en el contenedor con el ID 'map'
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Agrega una capa de mosaico (tile layer) de OpenStreetMap al mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Agrega un marcador en una ubicación específica
        L.marker([51.5, -0.09]).addTo(map)
            .bindPopup('Ubicación del usuario')
            .openPopup();
    </script>
@endsection