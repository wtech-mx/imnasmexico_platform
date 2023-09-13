<section class="py-3">
    <div class="row mt-lg-4 mt-2">
        @foreach ($minis_exps as $mini_exp)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <a href="{{ route('edit.mini_exp', $mini_exp->id) }}">
                                    <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                        @if ($documentos->logo == NULL)
                                            <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="img-blur-shadow">
                                        @else
                                            <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="img-blur-shadow">
                                        @endif
                                    </div>
                                    <div class="ms-3 my-auto">
                                        <h6>{{$mini_exp->nombre}} {{$mini_exp->apellido}}</h6>
                                        <div class="avatar-group">
                                            @if ($mini_exp->acta != NULL)
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Acta de Nacimiento">
                                                    <img alt="Image placeholder" src="{{asset('assets/user/icons/cheque-de-pago.png')}}">
                                                </a>
                                            @endif
                                            @if ($mini_exp->curp != NULL)
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="CURP">
                                                <img alt="Image placeholder" src="{{asset('assets/user/icons/cedula.png')}}">
                                                </a>
                                            @endif
                                            @if ($mini_exp->ine != NULL)
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="INE">
                                                <img alt="Image placeholder" src="{{asset('assets/user/icons/flag.png')}}">
                                                </a>
                                            @endif
                                            @if ($mini_exp->comprobante != NULL)
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comprobante de domicilio">
                                                <img alt="Image placeholder" src="{{asset('assets/user/icons/location-pointer.png')}}">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                                <p class="text-sm mt-3"> {{ $mini_exp->email }} <br> {{ $mini_exp->celular }} </p>
                                <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-sm mb-0">{{ $loop->iteration }}</h6>
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Expediente</p>
                                </div>
                                <div class="col-6 text-end">
                                    <h6 class="text-sm mb-0">{{ $mini_exp->created_at->format('d.m.y') }}</h6>
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Fecha Creación</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        @endforeach

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column justify-content-center text-center">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa fa-plus text-secondary mb-3"></i>
              <h5 class=" text-secondary"> New project </h5>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
