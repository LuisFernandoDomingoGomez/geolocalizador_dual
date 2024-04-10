@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <!-- Carrusel -->
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="dist/images/font.jpg" alt="First slide" style="max-height: 380px;">
                    <div class="carousel-caption d-none d-md-block">
                        <button class="btn btn-primary btn-download" onclick="installPWA()">Descargar aplicación</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="dist/images/font.jpg" alt="Second slide" style="max-height: 380px;">
                    <div class="carousel-caption d-none d-md-block">
                        <button class="btn btn-primary btn-download" onclick="installPWA()">Descargar aplicación</button>
                    </div>
                </div>
            </div>
            <script>
                let deferredPrompt;

                window.addEventListener('beforeinstallprompt', (e) => {
                    // Prevent Chrome 67 and earlier from automatically showing the prompt
                    e.preventDefault();
                    // Stash the event so it can be triggered later.
                    deferredPrompt = e;
                    // Show the custom button
                    document.querySelectorAll('.btn-download').forEach(button => {
                        button.style.display = 'block';
                    });
                });

                function installPWA() {
                    if (deferredPrompt) {
                        // Show the install prompt
                        deferredPrompt.prompt();
                        // Wait for the user to respond to the prompt
                        deferredPrompt.userChoice.then((choiceResult) => {
                            if (choiceResult.outcome === 'accepted') {
                                console.log('User accepted the install prompt');
                            } else {
                                console.log('User dismissed the install prompt');
                            }
                            // Reset the deferred prompt variable, as it can only be used once
                            deferredPrompt = null;
                        });
                    }
                }
            </script>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Fin del carrusel -->

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Agregar el script de Bootstrap para el carrusel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endpush
