@extends('layouts.app_admin')

@section('template_title')
   Editar Nota
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Editar Nota</h3>
                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nota">Num Nota</label>
                                    <input type="text" class="form-control" value="{{$nota->id}}" disabled>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nota">Fecha</label>
                                    <input type="text" class="form-control" value="{{$nota->fecha}}" disabled>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nota">Total</label>
                                    <input type="text" class="form-control" value="{{$nota->total}}" disabled>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nota">Restante</label>
                                    <input type="text" class="form-control" value="{{$nota->restante}}" disabled>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nota">Nombre</label>
                                    <input type="text" class="form-control" value="{{$nota->User->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nota">Correo</label>
                                    <input type="text" class="form-control" value="{{$nota->User->email}}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nota">Telefono</label>
                                    <input type="text" class="form-control" value="{{$nota->User->telefono}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Cursos comprados</h3>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="tab-content">
                            <div class="row text-center">
                                <div class="col-7" style="background-color: #bb546c; color: #fff;">Nombre</div>
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha Curso</div>
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Precio</div>
                            </div>
                            @foreach ($notas_inscripcion as $order_ticket)
                                <div class="row text-center mt-2">
                                    <div class="col-7">{{$order_ticket->CursosTickets->nombre}}</div>
                                    <div class="col-2">{{$order_ticket->CursosTickets->fecha_inicial}}</div>
                                    <div class="col-2">{{$order_ticket->CursosTickets->precio}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Pagos</h3>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="tab-content">
                            <div class="row text-center">
                                <div class="col-4" style="background-color: #bb546c; color: #fff;">Monto</div>
                                <div class="col-4" style="background-color: #bb546c; color: #fff;">Metodo de Pago</div>
                                <div class="col-4" style="background-color: #bb546c; color: #fff;">Fecha</div>
                            </div>
                            @foreach ($notas_pagos as $order_ticket)
                                <div class="row text-center mt-2">
                                    <div class="col-4">{{$order_ticket->monto}}</div>
                                    <div class="col-4">{{$order_ticket->metodo_pago}}</div>
                                    <div class="col-4">{{$order_ticket->created_at}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
