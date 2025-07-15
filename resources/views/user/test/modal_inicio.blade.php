  @guest
  <!-- Modal de login -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
       data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- No hay botón `.close` aquí --}}
        <div class="modal-header">
          <h5 class="modal-title">Iniciar Sesión</h5>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('login.custom') }}" id="loginForm">
            @csrf
            <input type="text" name="tipo" value="test" hidden>
            <div class="input-group flex-nowrap mt-4">
                <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                <input class="form-control input_custom_login" type="number" id="username" name="username"  placeholder="Telefono" required>
            </div>

            <div class="input-group flex-nowrap mt-4">
                <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                <input class="form-control input_custom_login" type="text" id="password" name="password"   placeholder="Confirma Telefono" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endguest
