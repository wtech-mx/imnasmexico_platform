@extends('layouts.app_admin')

@section('template_title')
   Crear Curso
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Curso</h3>

                            <a class="btn"  href="{{ route('cursos.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>

                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('cursos.store') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fecha">Nombre</label>
                                            <input  id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fecha">Descripcion</label>
                                            <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control"></textarea>
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

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Fecha Inicial</label>
                                            <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Hora Inicial</label>
                                            <input type="time" id="hora_inicial" name="hora_inicial" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Fecha Final</label>
                                            <input type="date" id="fecha_final" name="fecha_final" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Hora Final</label>
                                            <input type="time" id="hora_final" name="hora_final" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Categoria</label>
                                            <select id="categoria" name="categoria" class="form-control">
                                                <option value="Faciales">Faciales</option>
                                                <option value="Corporales">Corporales</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Modalidad</label>
                                            <select id="modalidad" name="modalidad" class="form-control">
                                                <option value="Online">Online</option>
                                                <option value="Presencial">Presencial</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="sep" name="sep">
                                            <label for="nota">SEP</label>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="unam" name="unam">
                                            <label for="nota">UNAM</label>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="stps" name="stps">
                                            <label for="nota">STPS</label>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="redconocer" name="redconocer">
                                            <label for="nota">RedConocer</label>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="imnas" name="imnas">
                                            <label for="nota">IMNAS</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fecha">Objetivo</label>
                                            <textarea name="objetivo" id="objetivo" cols="10" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fecha">Temario</label>
                                            <textarea name="temario" id="temario" cols="10" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fecha">Informacion</label>
                                            <textarea name="informacion" id="informacion" cols="10" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fecha">Liga Meet/Direccion</label>
                                            <input type="text" id="recurso" name="recurso" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="destacado" name="destacado">
                                            <label for="nota">Destacado</label>
                                        </div>
                                    </div>

                                    <div class="form-check col-1">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value="1" id="estatus" name="estatus" checked>
                                            <label for="nota">Publicar</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                      <div class="card">
                                        <div class="card-header pb-0 px-3">
                                          <h6 class="mb-0">Tickets</h6>
                                        </div>
                                        <div id="formulario" class="mt-4">
                                            <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                            <div class="clonars">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="fecha">Nombre</label>
                                                            <input  id="nombre_ticket[]" name="nombre_ticket[]" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Fecha inicial</label>
                                                            <input  id="fecha_inicial_ticket[]" name="fecha_inicial_ticket[]" type="date" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Fecha final</label>
                                                            <input  id="fecha_final_ticket[]" name="fecha_final_ticket[]" type="date" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Precio</label>
                                                            <input  id="precio[]" name="precio[]" type="number" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="descripcion">Descripcion</label><br>
                                                            <textarea name="descripcion_ticket[]" id="descripcion_ticket[]" cols="10" rows="3" class="form-control"></textarea>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a class="btn"  href="{{ route('cursos.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                        Guardar
                                    </button>
                                </div>
                            </form>

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
