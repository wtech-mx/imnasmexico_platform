<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Agregar Estandar
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          @include('admin.clientes.perfil.cotizaciones.crear_estandar')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Estandares</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            @php
                $displayedFolders = []; // Keep track of displayed folders
            @endphp
            @foreach ($usuario_compro as $video)
                @if ($video->Cursos->CursosEstandares->count() > 0)
                    @foreach ($estandaresComprados as $estandar)
                        @php
                            // Check if the folder has been displayed already
                            if (!in_array($estandar->nombre, $displayedFolders)) {
                                $displayedFolders[] = $estandar->nombre; // Mark the folder as displayed
                            } else {
                                continue; // Skip displaying the folder if it has been displayed already
                            }
                        @endphp
                        {{-- <div class="col-4">
                            <img class="" src="{{asset('assets/user/icons/folder.png')}}" style="height: 10%;">
                        </div> --}}
                        <div class="col-12">
                            <p style="color: #836262"><b>{{$estandar->nombre}}</b></p>
                        </div>
                    @endforeach
                @endif
            @endforeach
            @foreach ($estandar_user as $estandar)
                @if ($estandar->Estandar)
                    <div class="col-8">
                        <p style="color: #25748c"><b> {{$estandar->Estandar->nombre}}</b></p>
                    </div>
                    <div class="col-4">
                        <form action="{{ route('peril_cliente.destroy_estandares', $estandar->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="text" name="estandar_id" value="{{ $estandar->Estandar->id }}" hidden>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este estándar?')">
                                Borrar
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.estandares').select2();
        });
    </script>
@endsection
