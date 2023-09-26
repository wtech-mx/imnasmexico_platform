<div class="col-12 mb-5">
    <h1 class="text-center tittle_bold_cam">Bienvenido <br>
        @if($usuario->cliente == '4')
            Centro Evaluador
        @else
            Evaluador independiente
        @endif
    </h1>

    <div class="d-flex justify-content-around">
        @if($usuario->num_user == null or $usuario->num_user == "" )
        <p class="text-white text-center">
        </p>
        @else
        <p class="text-white text-center"><strong>No SEP:</strong> <br>
            {{ $usuario->num_user }}
        </p>
        @endif

        <h3 class="text-center tittle_border_cam">{{ $usuario->name }}</h3>
        @if($usuario->usuario_eva == null or $usuario->usuario_eva == "" )
        <p class="text-white text-center">
        </p>
        @else
        <p class="text-white text-center">
            <strong>Usuario:</strong> <br>
            {{ $usuario->usuario_eva }} <br>
            <strong>Contraseña:</strong> <br>
            {{ $usuario->contrasena_eva }}
        </p>
        @endif

    </div>
</div>
