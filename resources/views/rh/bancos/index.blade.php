@extends('layouts.app_admin')

@section('template_title')
Bancos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('panel.index') }}" class="btn" style="background: {{$configuracion->color_boton_close}}; color: #ffff; margin-right: 3rem;">
                                Regresar
                            </a>
                            <h2 id="card_title">
                                Bancos
                            </h2>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bancoModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                  </button>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($bancos as $item)
                            <div class="col-lg-4 mt-lg-0 mt-4">
                                <a href="{{ route('edit.bancos',$item->id) }}">
                                    <div class="card bg-transparent shadow-xl">
                                        <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                                            <span class="mask bg-gradient-dark"></span>
                                            <div class="card-body position-relative z-index-1 p-3">
                                                <h4 class="text-white mb-0">{{ $item->nombre_beneficiario }}</h4>
                                                <h5 class="text-white mt-4 mb-5 pb-2">{{ chunk_split($item->clabe, 4, ' ') }}</h5>
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <div class="me-4">
                                                            <p class="text-white text-sm opacity-8 mb-0">Nombre Banco</p>
                                                            <h6 class="text-white mb-0">{{ $item->nombre_banco }}</h6>
                                                        </div>
                                                        <div>
                                                            <p class="text-white text-sm opacity-8 mb-0">Dinero en banco</p>
                                                            <h6 class="text-white mb-0">${{ number_format($item->saldo, 0, '.', ',') }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                        <img class="w-60 mt-2" src="../../assets/img/logos/mastercard.png" alt="logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rh.modal_create_banco')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
