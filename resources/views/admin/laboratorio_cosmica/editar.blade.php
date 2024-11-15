@extends('layouts.app_admin')

@section('template_title')
    Edit Envase
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="" action="{{ route('envases.update', $envases->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body row">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label for="name">Envase</label>
                                        <input id="envase" name="envase" type="text" class="form-control" value="{{$envases->envase}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Conteo</label>
                                        <input id="conteo" name="conteo" type="number" class="form-control" value="{{$envases->conteo}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Cama/Caja</label>
                                        <input id="cama" name="cama" type="text" class="form-control" value="{{$envases->cama}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Categoria</label>
                                        <input id="categoria" name="categoria" type="text" class="form-control" value="{{$envases->categoria}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="imagenes">Link drive img</label>
                                        <input id="imagen" name="imagen" type="text" class="form-control" value="{{$envases->imagen}}">
                                        <img id="blah" src="{{$envases->imagen}}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Descripcion</label>
                                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" >{{$envases->descripcion}}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="name">Productos</label>
                                        <select class="form-control js-example-basic-multiple2" id="productos_edit[]" name="productos_edit[]" multiple style="width: 70%;!important">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @foreach ($envases_productos as $envase_producto)
                                        <div class="col-1">
                                            <img id="blah" src="{{$envase_producto->Product->imagenes}}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                        </div>
                                        <div class="col-11">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control d-inline-block" value="{{ $envase_producto->Product->nombre }}" readonly>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit"  class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple2').select2();
    });
</script>
@endsection
