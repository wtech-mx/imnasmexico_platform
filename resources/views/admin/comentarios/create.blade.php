@extends('layouts.app_admin')

@section('template_title')
   Crear comentarios
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto mt-4 mb-sm-5 mb-3">

                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                                <form class="multisteps-form__form mb-8"  method="POST" action="{{ route('comentarios.store') }}" enctype="multipart/form-data" role="form" style="height: 400px;">
                                    @csrf
                                    <!--single Datos Generales panel-->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Nombre</label>
                                                        <input  id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">mensaje</label>
                                                        <textarea name="mensaje" id="mensaje" cols="10" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nota">Foto</label>
                                                        <input type="file" id="foto" name="foto" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                            </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_custom')
    <script>
        function readURL(input) {
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
        var reader = new FileReader(); //Leemos el contenido

        reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    }

    $("#foto").change(function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
    readURL(this);
    });
    </script>

<script type="text/javascript">
    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario .clonars').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario');
    });
    </script>
@endsection
