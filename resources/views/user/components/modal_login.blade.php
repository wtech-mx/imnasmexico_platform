<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modalblur">

      <div class="modal-content modal_content_login">

        <div class="modal-body">
          <div class="row">
            <div class="col-12">

                <p class="text-center tittle_modal_login">Acceso alumnas</p>

                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <div class="input-group flex-nowrap mt-4">
                            <span class="input-group-text span_custom_login" id=""><i class="fas fa-phone-alt"></i></span>
                            <input type="text" placeholder="Email" id="email" class="input-group-text span_custom_login" name="email" required
                                autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="input-group flex-nowrap mt-4">
                            <span class="input-group-text span_custom_login" id=""><i class="fas fa-phone-alt"></i></span>
                            <input id="password" name="password" type="number" class="form-control input_custom_login" placeholder="Telefono" >
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Recordarme
                                </label>
                            </div>
                        </div>

                        <p class="text-center mt-5">
                            <button class="btn btn_login_modal">
                                Ingresar <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </p>

                    </form>

                    {{-- <form action="{{ route('register.custom') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                required autofocus>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email" class="form-control"
                                name="email" required autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="number" placeholder="telefono" id="telefono" class="form-control"
                                name="telefono" required>
                            @if ($errors->has('telefono'))
                            <span class="text-danger">{{ $errors->first('telefono') }}</span>
                            @endif
                        </div>
                        <input type="hidden" placeholder="cliente" id="cliente" class="form-control"
                                name="cliente" value="1">
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                        </div>
                    </form> --}}
                </div>

            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
