<div class="row">
    <div class="col-12">
        <h2 class="title_curso mb-5">Material de Clase</h2>
    </div>
    @foreach ($order_ticket as $tiket)
        @if ($tiket->Cursos->materiales != NULL && $tiket->Cursos->estatus == '1')
        <div class="col-6 mt-3">
            <b><label>Nombre Curso/Diplomado</label></b><br>
            <label>{{$tiket->Cursos->nombre}}</label>
            <img id="blah" src="{{asset('materiales/'.$tiket->Cursos->materiales) }}" alt="Imagen" style="width: 450px; height: 450px;"/>
        </div>
            <hr>
        @endif
    @endforeach
</div>
