<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Empresa') }}
            {{ Form::select('empresa_id', $empresas, null, ['class' => 'form-control' . ($errors->has('empresa_id') ? ' is-invalid' : ''), 'placeholder' => '--Empresa--']) }}
            {!! $errors->first('empresa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            <button type="button" id="getLocationBtn" class="btn btn-primary">Obtener Ubicación</button>
        </div>

        <!-- Aquí se mostrará la ubicación obtenida -->
        <div id="locationDisplay"></div>

        <!-- Campos ocultos para latitud y longitud -->
        {{ Form::hidden('latitud', null, ['id' => 'latitud']) }}
        {{ Form::hidden('longitud', null, ['id' => 'longitud']) }}
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>

<script>
    document.getElementById('getLocationBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Tu navegador no soporta la geolocalización.');
        }
    });

    function showPosition(position) {
        var locationDisplay = document.getElementById('locationDisplay');
        locationDisplay.innerHTML = 'Latitud: ' + position.coords.latitude + '<br>Longitud: ' + position.coords.longitude;

        // Rellenar campos ocultos de formulario con las coordenadas obtenidas
        document.getElementById('latitud').value = position.coords.latitude;
        document.getElementById('longitud').value = position.coords.longitude;
    }
</script>
