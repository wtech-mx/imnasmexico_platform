@extends('layouts.app_admin')

@section('template_title')
   Crear Curso
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form">
                <div class="row">
                    <div class="col-12 mx-auto mt-4 mb-sm-5 mb-3">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" type="button" title="Product Info">
                            <span>1. Datos Generales</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Media">2. Fecha y Hora</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Socials">3. Información</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Pricing">4. Tickets</button>
                        </div>

                        <div class="row">
                            <div class="col-12 m-auto">
                                <form class="multisteps-form__form mb-8"  method="POST" action="{{ route('cursos.store') }}" enctype="multipart/form-data" role="form" style="height: 400px;">
                                    @csrf
                                    @include('admin.cursos.modal_imagen')
                                    <!--single Datos Generales panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Datos Generales</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">

                                                <div class="form-group col-12">
                                                    <label for="name">Nombre del curso*</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input  id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Objetivo">Objetivo *</label>
                                                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" >-</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px"> Seleccionar foto
                                                        </button>
                                                        <input type="hidden" name="foto" id="foto">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="estandar">Seleccionar Estandar</label>
                                                        <select class="form-control" id="id_estandar[]" name="id_estandar[]" multiple="multiple">
                                                            <option value="">Seleccionar Estandar</option>
                                                          @foreach ($estandares as $estandar)
                                                          <option value="{{ $estandar->id }}">{{ $estandar->name }}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="estandar">Seleccionar Carpeta Materiales</label>
                                                        <select class="form-control carpeta_mat" id="carpeta" name="carpeta">
                                                            <option value="">Seleccionar carpeta</option>
                                                          @foreach ($carpetas as $carpeta)
                                                          <option value="{{ $carpeta->id }}">{{ $carpeta->nombre }}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 form-group">
                                                    <label for="name">Seleccionar Profesor *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/maestro.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select name="id_profesor" id="id_profesor" class="form-select d-inline-block">
                                                            <option value="">Seleccionar Profesor</option>
                                                            @foreach ($profesores as $profesor)
                                                            <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="name">Direccion</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/location-pointer.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input  id="direccion" name="direccion" type="text" class="form-control"  value="Castilla 136, Álamos, Benito Juárez, 03400, CDMX">
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="name">Iframe del mapa</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/abc-block.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input  id="mapa_iframe" name="mapa_iframe" type="text" class="form-control"  value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Visibilidad de secciones</h5>
                                                </div>


                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">Productos *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/productos.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_productos" name="visibilidad_productos">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0">No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">Liga de clase</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/meet.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_liga_clase" name="visibilidad_liga_clase">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0">No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">Metodos de Pago</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/payment.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_metodos_pago" name="visibilidad_metodos_pago">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0">No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">FAQS</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/informacion.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_faqs" name="visibilidad_faqs">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0">No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">Contactanos</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_contactanos" name="visibilidad_contactanos">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0">No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 form-group">
                                                    <label for="name">Galeria</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select class="form-control" id="visibilidad_carusel" name="visibilidad_carusel">
                                                            <option value="" selected>Visible</option>
                                                            <option value="0" >No visible</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Sig.</button>
                                            </div>
                                        </div>
                                    </div>
                                     <!--single Fecha y hora panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Fecha y Hora</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="nota">Fecha Inicial</label>
                                                        <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="nota">Hora Inicial</label>
                                                        <input type="time" id="hora_inicial" name="hora_inicial" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="nota">Fecha Final</label>
                                                        <input type="date" id="fecha_final" name="fecha_final" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="nota">Hora Final</label>
                                                        <input type="time" id="hora_final" name="hora_final" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-check col-4">
                                                    <label for="nota">Sin Hora F.</label>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="sin_fin" name="sin_fin">
                                                    </div>
                                                </div>

                                                {{-- <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nota">Categoria</label>
                                                        <select id="categoria" name="categoria" class="form-control">
                                                            <option value="Faciales">Faciales</option>
                                                            <option value="Corporales">Corporales</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                <div class="col-4 form-group">
                                                    <label for="name">Modalidad</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select id="modalidad" name="modalidad" class="form-control">
                                                            <option value="Online">Online</option>
                                                            <option value="Presencial">Presencial</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4 form-group">
                                                    <label for="name">Liga Meet/Direccion</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/meet.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input type="text" id="recurso" name="recurso" class="form-control">
                                                    </div>
                                                </div>

                                                {{-- <div class="form-check col-2">
                                                    <label for="nota">Destacado</label>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="destacado" name="destacado">

                                                    </div>
                                                </div> --}}

                                                <div class="form-check col-3">
                                                    <label for="nota">Seccion UNAM</label>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="seccion_unam" name="seccion_unam" >

                                                    </div>
                                                </div>


                                                <div class="form-check col-3">
                                                    <label for="nota">Certificacion Webinar</label>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="certificacion_webinar" name="certificacion_webinar" >
                                                    </div>
                                                </div>

                                                <div class="form-check col-2">
                                                    <label for="nota">Publicar</label>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="estatus" name="estatus" checked>

                                                    </div>
                                                </div>

                                                <h5 class="mb-5 mt-5">Documentacion</h5>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="sep" name="sep">
                                                        <label for="nota">RVOE</label>
                                                    </div>
                                                </div>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="unam" name="unam">
                                                        <label for="nota">UNAM</label>
                                                    </div>
                                                </div>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="stps" name="stps">
                                                        <label for="nota">STPS</label>
                                                    </div>
                                                </div>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="redconocer" name="redconocer">
                                                        <label for="nota">RedConocer</label>
                                                    </div>
                                                </div>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="imnas" name="imnas">
                                                        <label for="nota">IMNAS</label>
                                                    </div>
                                                </div>

                                                <div class="form-check col-3">
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" value="1" id="titulo_hono" name="titulo_hono">
                                                        <label for="nota">Titulo Honorifico</label>
                                                    </div>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="name">Paquete de STPS</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="">
                                                            <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select id="opcion" name="pack_stps" class="form-control">
                                                            <option value="Si">Si</option>
                                                            <option selected value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3 " id="contentGenerarSKU" style="display: none;">

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 1</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_1" name="p_stps_1" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 2</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_2" name="p_stps_2" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 3</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_3" name="p_stps_3" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 4</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_4" name="p_stps_4" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 5</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_5" name="p_stps_5" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                    <div class="col-6 form-group">
                                                        <label for="name">Nomnre de STPS 6</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">
                                                                <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input  id="p_stps_6" name="p_stps_6" type="text" class="form-control" placeholder="Nombre" >
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button" title="Prev">Ante.</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Sig.</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single Temario panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Información</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                {{-- <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Objetivo</label>
                                                        <textarea name="objetivo" id="objetivo" cols="10" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div> --}}

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Temario</label>
                                                        <textarea name="temario" id="temario" cols="10" rows="3" class="form-control">-</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha">RVOE</label>
                                                        <textarea name="texto_rvoe" id="texto_rvoe" cols="10" rows="3" class="form-control">-</textarea>
                                                    </div>
                                                </div>

                                                <div class=" col-12">
                                                    <div class="form-group">
                                                        <label for="nota">CONOCER</label>
                                                        <textarea name="texto_conocer" id="texto_conocer" cols="10" rows="3" class="form-control">-</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <img src="{{ asset('assets/user/icons/stack-of-books.png') }}" alt="" width="35px"> Materiales de Clase
                                                            </button>
                                                            <input type="hidden" name="materiales" id="materiales">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="name">Liga Material</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/enlace.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input type="text" id="btn_cotizacion" name="btn_cotizacion" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <img src="{{ asset('assets/user/icons/pdf.png') }}" alt="" width="35px">  PDF Descarga
                                                            </button>
                                                            <input type="hidden" name="pdf" id="pdf">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button" title="Prev">Ante.</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Sig.</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single Temario panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Tickets</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div id="formulario" class="mt-4">
                                                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                                    <div class="clonars">
                                                        <div class="row">

                                                            <div class="col-12 form-group">
                                                                <label for="name">Nombre</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                                                    </span>
                                                                    <input id="nombre_ticket[]" name="nombre_ticket[]" type="text" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 form-group">
                                                                <label for="name">Fecha inicial</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/user/icons/calendario.png') }}" alt="" width="35px">
                                                                    </span>
                                                                    <input  id="fecha_inicial_ticket[]" name="fecha_inicial_ticket[]" type="date" class="form-control" >
                                                                </div>
                                                            </div>

                                                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 form-group">
                                                                <label for="name">Fecha final</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/user/icons/calendario.png') }}" alt="" width="35px">
                                                                    </span>
                                                                    <input  id="fecha_final_ticket[]" name="fecha_final_ticket[]" type="date" class="form-control" >
                                                                </div>
                                                            </div>

                                                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 form-group">
                                                                <label for="name">Precio</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/user/icons/money.png') }}" alt="" width="35px">
                                                                    </span>
                                                                    <input  id="precio[]" name="precio[]" type="number" class="form-control" >
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="descripcion">Descripcion</label><br>
                                                                    <textarea name="descripcion_ticket[]" id="descripcion_ticket[]" cols="10" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row d-flex mt-4">
                                                <div class="col-12">
                                                    <button class="btn btn-secondary mt-3 js-btn-prev" type="button" title="Prev"><img src="{{ asset('assets/user/icons/back.png') }}" alt="" width="35px"> Ant.</button>
                                                    <button class="btn btn-success close-modal mt-3" type="submit"  style=""><img src="{{ asset('assets/user/icons/salvar.png') }}" alt="" width="35px">  Guardar</button>
                                                </div>
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
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/admin/js/plugins/multistep-form.js')}}"></script>

   <script src="https://cdn.tiny.cloud/1/j1jav9k6mblf3p1zkwu0fxf5yfhp7b4inzjxkxfteidvmluh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   <script>
        $(document).ready(function() {

            $('.carpeta_mat').select2();

            // Manejar el cambio en el select
            $('#opcion').change(function() {
                var selectedOption = $(this).val();

                // Ocultar todas las secciones al cambiar la opción
                $('#contentGenerarSKU').hide();

                // Mostrar la sección correspondiente según la opción seleccionada
                if (selectedOption === 'Si') {
                    $('#contentGenerarSKU').show();
                }
            });

        });

     tinymce.init({
       selector: '#descripcion', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });

     tinymce.init({
       selector: '#temario', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });

     tinymce.init({
       selector: '#texto_rvoe', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });

     tinymce.init({
       selector: '#texto_conocer', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });

     tinymce.init({
       selector: '#descripcion_ticket', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });

     tinymce.init({
       selector: '#materiales_ticket', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists'
     });


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


        function selectImage(foto) {
            $('#foto').val(foto);
        }

        function selectPdf(pdf) {
            $('#pdf').val(pdf);
        }

        function selectMateriales(materiales) {
            $('#materiales').val(materiales);
        }


    </script>
@endsection
