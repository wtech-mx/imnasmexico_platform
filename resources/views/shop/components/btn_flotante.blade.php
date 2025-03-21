<div class="container_btn_flotante">
    <input type="checkbox" id="btn-mas">
    <div class="redes">
        <a target="_blank" href="tel:5215521826992" class="phone fas fa-phone-alt">
            <img src="{{ asset('ecommerce/iconos/call.png') }}" class="icons_btn_flotante" alt="">
        </a>
        <a target="_blank" href="{{ $configuracion->instagram }}" class="insta">
            <img src="{{ asset('ecommerce/iconos/insta.png') }}" class="icons_btn_flotante" alt="">
        </a>
        <a target="_blank" href="{{ $configuracion->facebook }}" class="face">
            <img src="{{ asset('ecommerce/iconos/face.png') }}" class="icons_btn_flotante" alt="">
        </a>
        <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $configuracion->whatsapp }}" class="whats ">
            <img src="{{ asset('ecommerce/iconos/whats.png') }}" class="icons_btn_flotante" alt="">
        </a>
    </div>
    <div class="btn-mas">
        <label for="btn-mas" class="fab"><i class="bi bi-whatsapp"></i></label>
    </div>
</div>
