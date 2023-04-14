
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modalblur">

      <div class="modal-content modal_content_login">

        <div class="modal-body">
          <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn_close_custom" data-bs-dismiss="modal">X</button>
                </div>

                <div class="d-flex justify-content-center">
                    <p class="text-center tittle_modal_login">Acceso alumn@s</p>
                </div>

                <nav>
                    <div class="d-flex justify-content-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">
                                Iniciar Sesion
                            </button>

                            <button class="nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                                Registrar
                            </button>
                        </div>
                    </div>
                  </nav>

                  <div class="tab-content" id="nav-tabContent" style="">
                    <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">

                        <div class="d-flex justify-content-center">
                            <form method="POST" action="{{ route('login.custom') }}">
                                @csrf

                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                                    <input class="form-control input_custom_login" type="username" id="username" name="username"  placeholder="Telefono" required>
                                </div>

                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                                    <input class="form-control input_custom_login" type="number" id="password" name="password"   placeholder="Confirma Telefono" required>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" > Recordarme
                                        </label>
                                    </div>
                                </div>

                                <p class="text-center mt-5">
                                    <button class="btn btn_login_modal">
                                        Ingresar <i class="fas fa-arrow-circle-right"></i>
                                    </button>
                                </p>

                            </form>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('register.custom') }}" method="POST">
                                @csrf

                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_login" ><i class="fas fa-user"></i></span>
                                    <input class="form-control input_custom_login" type="text" id="name" name="name"   placeholder="Nombre Completo" required>
                                </div>
                                @if ($errors->has('name'))
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                @endif

                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_login" ><i class="fas fa-envelope"></i></span>
                                    <input class="form-control input_custom_login" type="text" id="email" name="email"   placeholder="Correo" required>
                                </div>

                                @if ($errors->has('email'))
                                <div class="input-group flex-nowrap mt-4">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                @endif

                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                                    <input class="form-control input_custom_login" type="number" id="telefono" name="telefono"   placeholder="Telefono" required>
                                </div>
                                @if ($errors->has('telefono'))
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="text-danger">{{ $errors->first('telefono') }}</span>
                                </div>
                                @endif

                                <input type="hidden" placeholder="cliente" id="cliente" class="form-control" name="cliente" value="1">


                                <p class="text-center mt-5">
                                    <button class="btn btn_login_modal" type="submit">
                                        Registrar <i class="fas fa-arrow-circle-right"></i>
                                    </button>
                                </p>

                            </form>
                        </div>
                    </div>

                  </div>


            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
