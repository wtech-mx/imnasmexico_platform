@extends('layouts.app_admin')

@section('template_title')
   Editar Curso
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto mt-4 mb-sm-5 mb-3">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" type="button" title="Product Info">
                            <span>1. Datos Generales</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Media">2. Fecha y Hora</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Socials">3. Temario</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Pricing">4. Tickets</button>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                                <form class="multisteps-form__form mb-8" style="height: 400px;" method="POST" action="{{ route('cursos.update', $curso->id) }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <!--single Datos Generales panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Datos Generales</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Nombre</label>
                                                        <input  id="nombre" name="nombre" type="text" class="form-control" value="{{$curso->nombre}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Descripcion</label>
                                                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control"> {{$curso->descripcion}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nota">Foto</label>
                                                        <input type="file" id="foto" name="foto" class="form-control" value="{{$curso->foto}}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <img id="blah" src="{{asset('cursos/'.$curso->foto) }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nota">Clase Grabada</label>
                                                        <input type="file" id="clase_grabada" name="clase_grabada" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                     <!--single Fecha y hora panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Fecha y Hora</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Fecha Inicial</label>
                                                        <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" value="{{$curso->fecha_inicial}}">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Hora Inicial</label>
                                                        <input type="time" id="hora_inicial" name="hora_inicial" class="form-control" value="{{$curso->hora_inicial}}">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Fecha Final</label>
                                                        <input type="date" id="fecha_final" name="fecha_final" class="form-control" value="{{$curso->fecha_final}}">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Hora Final</label>
                                                        <input type="time" id="hora_final" name="hora_final" class="form-control" value="{{$curso->hora_final}}">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nota">Categoria</label>
                                                        <select id="categoria" name="categoria" class="form-control">
                                                            <option value="{{$curso->categoria}}">{{$curso->categoria}}</option>
                                                            <option value="Faciales">Faciales</option>
                                                            <option value="Corporales">Corporales</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nota">Modalidad</label>
                                                        <select id="modalidad" name="modalidad" class="form-control">
                                                            <option value="{{$curso->modalidad}}">{{$curso->modalidad}}</option>
                                                            <option value="Online">Online</option>
                                                            <option value="Presencial">Presencial</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->sep == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="sep" name="sep" checked>
                                                            <label for="nota">SEP</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="sep" name="sep">
                                                            <label for="nota">SEP</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->unam == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="unam" name="unam" checked>
                                                            <label for="nota">UNAM</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="unam" name="unam">
                                                            <label for="nota">UNAM</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->stps == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="stps" name="stps" checked>
                                                            <label for="nota">STPS</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="stps" name="stps">
                                                            <label for="nota">STPS</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->redconocer == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="redconocer" name="redconocer" checked>
                                                            <label for="nota">RedConocer</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="redconocer" name="redconocer">
                                                            <label for="nota">RedConocer</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->imnas == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="imnas" name="imnas" checked>
                                                            <label for="nota">IMNAS</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="imnas" name="imnas">
                                                            <label for="nota">IMNAS</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                     <!--single Temario panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Temario</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Objetivo</label>
                                                        <textarea name="objetivo" id="objetivo" cols="10" rows="3" class="form-control"> {{$curso->objetivo}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Temario</label>
                                                        <textarea name="temario" id="temario" cols="10" rows="3" class="form-control"> {{$curso->temario}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Informacion</label>
                                                        <textarea name="informacion" id="informacion" cols="10" rows="3" class="form-control"> {{$curso->informacion}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fecha">Liga Meet/Direccion</label>
                                                        <input type="text" id="recurso" name="recurso" class="form-control" value="{{$curso->recurso}}">
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->destacado == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="destacado" name="destacado" checked>
                                                            <label for="nota">Destacado</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="destacado" name="destacado">
                                                            <label for="nota">Destacado</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <div class="form-group">
                                                        @if ($curso->estatus == 1)
                                                            <input class="form-check-input" type="checkbox" value="1" id="estatus" name="estatus" checked>
                                                            <label for="nota">Publicar</label>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="1" id="estatus" name="estatus">
                                                            <label for="nota">Publicar</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                     <!--single Tickets panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Tickets</h5>
                                        <div class="multisteps-form__content mt-3">
                                            <div class="row">
                                                @foreach ($tickets as $item)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="fecha">Nombre</label>
                                                                <input value="{{$item->nombre}}" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Fecha inicial</label>
                                                                <input value="{{$item->fecha_inicial}}" type="date" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Fecha final</label>
                                                                <input value="{{$item->fecha_final}}" type="date" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Precio</label>
                                                                <input value="{{$item->precio}}" type="number" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Descuento</label>
                                                                <input value="{{$item->descuento}}" type="number" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="descripcion">Descripcion</label><br>
                                                                <textarea cols="10" rows="3" class="form-control">{{$item->descripcion}}</textarea>
                                                            </div>
                                                        </div>


                                                    </div>
                                                @endforeach
                                                <div id="formulario" class="mt-4">
                                                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                                    <div class="clonars">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="fecha">Nombre</label>
                                                                    <input  id="nombre_ticket[]" name="nombre_ticket[]" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label for="num_sesion">Fecha inicial</label>
                                                                    <input  id="fecha_inicial_ticket[]" name="fecha_inicial_ticket[]" type="date" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label for="num_sesion">Fecha final</label>
                                                                    <input  id="fecha_final_ticket[]" name="fecha_final_ticket[]" type="date" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label for="num_sesion">Precio</label>
                                                                    <input  id="precio[]" name="precio[]" type="number" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label for="num_sesion">Descuento</label>
                                                                    <input  id="descuento[]" name="descuento[]" type="number" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="descripcion">Descripcion</label><br>
                                                                    <textarea id="descripcion_ticket" name="descripcion_ticket[]" cols="10" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                             </div>
                                        </div>
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

    $("#foto").change(function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se ver?? reflejado.
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
