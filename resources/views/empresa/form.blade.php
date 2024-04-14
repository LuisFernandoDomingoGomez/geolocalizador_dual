<div class="box box-info padding-1">
    <div class="box-body">
        <div class="mb-4">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $empresa->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <!-- Ocultamos el texto y el input, conservando la funcionalidad -->
            <label for="imagen-input" class="file-label" style="cursor: pointer;">
                <div id="dropArea" class="drop-area">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Arrastra y suelta tu archivo aquí o haz clic para seleccionar</span>
                </div>
            </label>
            <!-- Mantenemos el input para la selección de archivos -->
            {{ Form::file('imagen', ['class' => 'hidden', 'id' => 'imagen-input', 'accept' => 'image/*', 'style' => 'display: none;']) }}
        </div>

    </div>
    <div class="box-footer mt-4">
        <div class="float-right">
            <a href="{{ route('empresas.index') }}" class="btn btn-danger mr-2">{{ __('Regresar') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .drop-area {
        height: 300px;
        width: 210%;
        border: 2px dashed #ccc;
        text-align: center;
        padding-top: 100px;
        cursor: pointer;
        position: relative;
    }

    .drop-area i {
        font-size: 40px;
        color: #777;
    }

    .drop-area span {
        display: block;
        margin-top: 20px;
        color: #777;
        font-size: 18px;
    }

    .file-label {
        width: fit-content;
        display: inline-block;
    }
</style>

<script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('imagen-input'); // Cambiamos el ID aquí

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#f7f7f7';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = 'transparent';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = 'transparent';
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        handleFile(file);
    });

    function handleFile(file) {
    if (file) {
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        const fileType = file.type;
        if (validImageTypes.includes(fileType)) {
            // Muestra la vista previa de la imagen
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;

                // Establece las dimensiones deseadas
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';

                // Ajusta el margen superior para alinear la imagen hacia arriba
                img.style.marginTop = '-150px'; // Ajusta el valor según sea necesario

                img.classList.add('preview-image');
                dropArea.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else {
            alert('Por favor seleccione un archivo de imagen válido.');
        }
    }
}


</script>
