@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas Cursos</h3>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_notas_productos" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>
                        </div>
                    </div>
                        <div class="card-body">

                            <div class="table-responsive">

                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.notas_productos.modal_create')
@endsection

@section('datatable')

@endsection


