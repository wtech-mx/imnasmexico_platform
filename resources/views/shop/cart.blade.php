@extends('layouts.app_ecommerce')

@section('template_title')

Carrito
 @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/css/single_product.css') }}">
    <style>
        .form-check-input:checked {
            background-color: #E5B467;
            border-color: #E5B467;
        }
    </style>
@endsection

@section('ecomeerce')

    <div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3  mt-10">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4 p-sm-3 p-md-3 p-lg-3">
                <h3 class="mb-4">Compras</h3>

                @if(session('cart'))
                    @foreach(session('cart') as $id => $producto)
                        @php
                            $producto_stock = App\Models\ProductosStock::where('id_producto', '=', $id)->first();
                            $esPorKg = isset($producto_stock->Producto->unidad_venta) &&
                                        ($producto_stock->Producto->unidad_venta === 'Kg' ||
                                            $producto_stock->Producto->unidad_venta === 'kg');
                            $precioPorKg = $producto_stock->precio_normal;
                            // Definir opciones según id_marca
                            $opciones = [];

                            if ($producto_stock->Producto->id_marca == 147 || $producto_stock->Producto->id_marca == 102) {
                                $opciones = [
                                    1 => $precioPorKg,
                                    0.5 => ($precioPorKg * 500) / 1000,
                                    2 => $precioPorKg * 2,
                                    3 => $precioPorKg * 3
                                ];
                            } elseif ($producto_stock->Producto->id_marca == 5) {
                                $opciones = [
                                    1 => $precioPorKg,
                                    2 => $precioPorKg * 2,
                                    3 => $precioPorKg * 3
                                ];
                            } else {
                                $opciones = [
                                    1 => $precioPorKg,
                                    0.6 => ($precioPorKg * 600) / 1000,
                                    0.4 => ($precioPorKg * 400) / 1000
                                ];
                            }
                        @endphp
                        <div class="container_order_item_cart row mb-4">
                            <div class="d-flex justify-content-between">

                                @if ($producto['imagen'] == NULL)
                                    <div class="mx-auto img_portada_cart" style="background: url({{ asset('ecommerce/Isotipo_negro.png') }}) #ffffff00  50% / contain no-repeat;"></div>
                                @else
                                <div class="mx-auto img_portada_cart" style="background: url(&quot;{{ asset('imagen_principal/empresa' . $empresa->id . '/' . $producto['imagen']) }}&quot;) #ffffff00  50% / contain no-repeat;"></div>

                                @endif

                                <p class="title_product_cart m-0 my-auto">{{ $producto['nombre'] }}</p>

                                <div class="container_item_cart my-auto" style="">
                                    @if ($esPorKg)
                                    <div class="d-flex align-items-center">
                                        <div href="javascript:void(0);" class="btn_menos decrementar_kg" data-id="{{ $id }}" data-marca="{{ $producto_stock->Producto->id_marca }}">
                                            <i class="bi bi-dash icon-small"></i>
                                        </div>

                                        <input type="text" class="btn_input_cart text-center" value="{{ $producto['cantidad'] }}" min="1"
                                               data-id="{{ $id }}" data-marca="{{ $producto_stock->Producto->id_marca }}" data-stock="{{ $producto['stock'] }}" readonly>

                                        <div href="javascript:void(0);" class="btn_plus incrementar_kg" data-id="{{ $id }}" data-marca="{{ $producto_stock->Producto->id_marca }}">
                                            <i class="bi bi-plus-lg icon-small"></i>
                                        </div>
                                    </div>
                                    @else
                                        <div href="javascript:void(0);" class="btn_menos d-inline decrementar" data-id="{{ $id }}"><i class="bi bi-dash icon-small"></i></div>
                                        <input type="number" class="btn_input_cart" value="{{ $producto['cantidad'] }}" min="1" data-id="{{ $id }}" data-stock="{{ $producto['stock'] }}">
                                        <div href="javascript:void(0);" class="btn_plus d-inline incrementar" data-id="{{ $id }}"><i class="bi bi-plus-lg icon-small"></i></div>
                                    @endif
                                </div>

                                <p class="title_price_cart m-0 my-auto" id="total-{{ $id }}">
                                    ${{ number_format($producto['precio'] * $producto['cantidad'], 2, '.', ',') }}
                                </p>


                                {{-- <p class="title_price_cart m-0 my-auto" id="total-{{ $id }}">${{ number_format($producto['precio'] * $producto['cantidad'], 0, '.', ',') }}</p> --}}
                                <a class="eliminar-producto m-0 my-auto" data-id="{{ $id }}" style="color:red;"><i class="bi bi-trash3 icon_tras_cart my-auto"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif

                @php
                    $cart_productos = session('cart', []);
                    $subtotal = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
                @endphp

                <h6 class="mt-0 subtotal_cart">Subtotal:  <span id="subtotal-carrito">${{ number_format($subtotal, 0, '.', ',') }}</span></h6>
                <h5 class="mt-0 envio_cart">Envío: <span id="envio-carrito">$0.00</span></h5>
                <p id="envio-gratis" style="color: green; display: none;">¡Envío Gratis!</p>
                <h4 class="mt-0 mb-3 total_cart">Total:  <span id="total-carrito">${{ number_format($subtotal, 0, '.', ',') }}</span></h4>

                <div class="input-group">
                    <span class="input-group-text input_cupon_cart" id="">
                        <i class="bi bi-ticket"></i>
                    </span>
                    <input type="text" class="form-control input_bg_cart" placeholder="Codigo de Cupon">
                </div>

                <p class="text-end">
                    <button class="btn btn_cupon_cart text-white mt-4">Aplicar Cupon</button>
                </p>

            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4 p-sm-3 p-md-3 p-lg-3">
                <form method="POST" action="{{ route('procesar.pago') }}">
                    @csrf
                    <div class="row">
                        <h3 class="mb-3">Detalles del cliente</h3>
                        <input type="hidden" name="total_carrito" id="total_carrito" value="{{ $subtotal }}">
                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-person-circle"></i>
                                    </span>
                                    <input type="text" name="nombre" class="form-control input_cart_pay" placeholder="Nombre Completo" required>
                        </div>

                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="correo" class="form-control input_cart_pay" placeholder="correo@correo.com" required>
                        </div>

                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" class="form-control input_cart_pay" placeholder="Telefono *" required>
                        </div>

                        @include('shop.components.inputs_factura')

                        <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                        <h3 class="">Detalles del Envio</h3>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="pickup" checked>
                                                    <label class="form-check-label" for="inlineRadio1">PickUp</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="domicilio">
                                                    <label class="form-check-label" for="inlineRadio2">Envio a Domicilio</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contenedor PickUp -->
                                        <div class="container_pickup row mt-3">
                                            <p>
                                                <a href="https://maps.app.goo.gl/WoEycdRbmkpVLquXA" style="color: #E5B467">
                                                    Mérida 64, Cuahutemoc 19-4214, -99.1579, Roma Nte., 06700 Ciudad de México, CDMX
                                                </a>
                                            </p>
                                            <iframe class="ifram_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.7954834491547!2d-99.16045332523932!3d19.421240581855653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffbe36afe1f7%3A0x3ea01a1b1ae9104c!2sZoco%20Fresh%20Roma%20Tienda%20org%C3%A1nica!5e0!3m2!1ses-419!2smx!4v1735834614408!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>

                                        <!-- Contenedor Envio a Domicilio -->
                                        <div class="container_envioDomicilio row mt-3" style="display: none;">

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-123"></i>
                                                </span>
                                                <input type="text" name="codigo_postal" class="form-control input_cart_pay" placeholder="CP">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-mailbox-flag"></i>
                                                </span>
                                                <input type="text" name="colonia" class="form-control input_cart_pay" placeholder="Colonia">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-geo-alt"></i>
                                                </span>
                                                <input type="text" name="estado" class="form-control input_cart_pay" placeholder="Estado">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-bank"></i>
                                                </span>
                                                <input type="text" name="alcaldia" class="form-control input_cart_pay" placeholder="Municipio o Alcaldia">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-signpost-split"></i>
                                                </span>
                                                <input type="text" name="calle_numero" class="form-control input_cart_pay" placeholder="Calle y numero">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-house"></i>
                                                </span>
                                                <input type="text" name="referencia" class="form-control input_cart_pay" placeholder="Referencia (Dep  Casa, Color , etc)">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                                                <a href="{{ route('terminos.index') }}" target="_blank" rel="noopener noreferrer">He leído y acepto los términos y condiciones del sitio.</a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <p class="text-center">
                                                <p id="mensaje-envio" style="color: red; display: none;"></p>
                                                <button id="btn-pagar" class="btn btn_cupon_cart text-white mt-2 w-100" type="submit">Pagar</button>
                                            </p>
                                        </div>
                                    </div>
                        </div>



                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection

@section('js_custom')

<script>
    $(document).ready(function() {

        // Definición de variables y objetos
        const zonas = {
            13: ["01588","01700","01708","01720","01770","01800","01807","01810","01820","01830","01840","01849","01857","01859","01860","01863","01870","01904","04500","04840","04899","04909","04918","04919","04920","04930","04938","04939","04950","04960","04970","05000","05010","05020","05030","05050","05100","05200","05219","05220","05230","05240","05260","05269","05270","05280","05310","05320","05330","05348","05360","05370","05379","05400","05410","05500","05520","05530","05600","05610","05700","05710","05730","05750","05760","05780","07100","07109","07110","07119","07130","07140","07144","07149","07150","07160","07164","07170","07180","07183","07187","07188","07189","07190","07199","07200","07207","07209","07210","07214","07220","07224","07239","07240","07259","09130","09140","09180","09200","10000","10010","10020","10130","10300","10320","10330","10340","10350","10360","10368","10369","10370","10378","10379","10380","10500","10580","10600","10610","10620","10630","10640","10660","10710","10800","10810","10820","10830","10840","10900","10910","10920","10926","12000","12070","12080","12100","12110","12200","12250","12300","12400","12410","12500","12600","12700","12800","12910","12920","12930","12940","12950","13000","13010","13020","13030","13040","13050","13060","13070","13080","13090","13093","13094","13099","13100","13120","13150","13180","13200","13210","13219","13220","13230","13250","13270","13273","13278","13280","13300","13310","13315","13319","13360","13400","13410","13419","13420","13430","13440","13450","13460","13508","13509","13510","13520","13530","13540","13545","13549","13550","13600","13610","13625","13630","13640","13700","14000","14010","14030","14039","14040","14049","14050","14060","14070","14080","14090","14100","14108","14110","14120","14140","14150","14160","14200","14208","14209","14210","14219","14220","14230","14239","14240","14248","14250","14260","14266","14267","14268","14269","14270","14275","14300","14308","14325","14326","14330","14340","14357","14360","14376","14377","14380","14386","14387","14388","14389","14390","14400","14406","14408","14409","14410","14420","14426","14427","14429","14430","14438","14439","14440","14449","14460","14470","14476","14479","14480","14490","14500","14600","14608","14609","14610","14620","14629","14630","14640","14643","14646","14647","14650","14653","14655","14657","14658","14659","14700","14710","14720","14730","14734","14735","14737","14738","14739","14740","14748","14749","14760","14900","15640","15660","16000","16010","16020","16029","16030","16034","16035","16036","16038","16040","16050","16059","16060","16070","16080","16083","16090","16100","16200","16210","16240","16300","16310","16320","16340","16400","16410","16420","16428","16429","16430","16440","16443","16450","16457","16459","16500","16513","16514","16520","16530","16533","16550","16600","16604","16605","16606","16607","16609","16610","16614","16615","16616","16617","16620","16629","16630","16640","16710","16720","16739","16740","16749","16750","16770","16776","16780","16797","16799","16800","16810","16813","16840","16850","16860","16880","16900"],
            12: ["01049","01060","01089","01090","01230","01239","01290","01330","01376","01389","01539","01549","01645","01729","01740","01780","01789","01900","02100","02230","02440","02710","02719","04440","04480","04489","04490","04510","04519","04700","04710","04730","04739","04800","04870","04890","04910","04929","04940","04980","05129","07090","07500","07509","07510","07530","07540","07550","07560","07580","07630","07650","07910","09208","09209","09230","09239","09240","09250","09260","09270","09280","09290","09300","09350","09359","09360","10200","10400","10700","14020","14310","14320","14350","14370","15400","15600","15620"],
            11: ["01259","01260","01296","01298","01299","01310","01320","01340","01377","01430","01500","01509","01520","01530","01538","01540","01548","01550","01560","01569","01590","01610","01618","01630","01650","01730","01750","01759","01760","01790","02120","02128","02129","02130","02140","02400","02410","04210","04260","04300","04369","04420","04450","04460","04470","04530","04600","04620","04630","04640","04650","04660","04810","04815","04830","05110","05118","05119","05120","07080","07089","07230","07250","07268","07270","07279","07280","07290","07310","07320","07330","07340","07350","07359","07360","07410","07420","07430","07440","07455","07520","07600","07640","07670","07707","07708","07900","07918","07919","07920","07940","07950","07969","07980","07990","08500","09100","09210","09220","09310","09319","09320","09819","09820","09828","09829","09830","09837","09838","09839","09840","09849","09850","09856","09858","09859","09860","09868","09870","09880","09890","09897","09900","09910","09920","09930","09940","09960","09969","09970","11700","15440","15520","15530","15610","15650","15680"],
            10: ["01080","01210","01219","01240","01250","01269","01270","01275","01276","01278","01279","01285","01289","01407","01408","01410","01450","01460","01470","01480","01490","01510","01566","01619","01620","01640","01710","02150","02160","02200","02240","02250","02300","02310","02320","02360","02420","02459","02460","02470","02480","02490","02519","02720","02750","04200","04240","04250","04330","04340","04360","04370","04380","04390","04400","04410","04610","07010","07040","07058","07060","07069","07070","07300","07369","07400","07450","07456","07460","07469","07470","07480","07570","07620","07680","07700","07720","07730","07739","07740","07754","07755","07760","07930","07939","07960","07970","07979","08510","08730","08760","08900","09000","09010","09020","09030","09040","09060","09070","09080","09089","09090","09099","09410","09420","09429","09430","09438","09440","09450","09460","09470","09479","09480","09500","09510","09520","09530","09550","09560","09570","09578","09600","09608","09609","09620","09630","09637","09638","09640","09648","09660","09670","09696","09698","09700","09704","09708","09709","09710","09720","09730","09740","09750","09760","09769","09770","09780","09790","09800","09810","11619","11910","11920","11930","11950","15320"],
            9: ["09680", "09689", "09690", "09705", "09706"],
            8: ["08770"],
            7: ["01180"],
            6: ["01000","01010","01020","01030","01040","01050","01070","01110","01170","01200","01220","01280","01400","01419","01420","01600","02000","02010","02020","02040","02050","02060","02070","02330","02340","02500","02520","02630","02700","02730","02760","02790","02810","02950","03230","03570","03580","03590","03700","03730","03900","03910","03920","03930","03940","04000","04010","04020","04030","04040","04120","04230","04310","04318","04320","07000","07020","07050","07370","07380","07750","07770","07780","07790","07800","07810","07820","07830","07838","07839","07840","07850","07858","07859","07860","07869","07870","07880","07889","07890","07899","08000","08010","08020","08030","08040","08100","08420","09400","11000","11210","11220","11650","15250","15300","15309","15310","15339","15370","15390","15410","15420","15430","15450","15470","15510","15540","15630","15670","15700","15730","15740","15750"],
            5: ["01100","01109","01120","01125","01130","01139","01140","01150","01160","02099","02530","02600","02640","02650","02670","02680","02770","02780","02800","02830","02840","02860","02870","02900","02910","02920","02930","02940","02960","02970","02980","02990","03104","03240","03300","03303","03310","03320","03330","03340","03400","03500","03540","03550","03560","03740","03800","04100","06350","06430","06450","06920","08240","08320","08400","08600","08610","08620","08650","08700","08710","08720","08800","08810","08830","08840","08910","08920","08930","11100","11200","11230","11240","11250","11260","11270","11289","11290","11410","11500","11510","11600","11610","15000","15010","15020","15200","15210","15220","15230","15240","15260","15270","15280","15290","15330","15340","15350","15460","15500","15710"],
            4: ["02660"],
            3: ["02080","02090","03023","03100","03200","03410","03420","03430","03440","03510","03520","03530","03600","03610","03620","03630","03640","03650","03660","03710","03720","03820","03840","06010","06020","06060","06200","06220","06240","06250","06270","06280","08200","08210","08220","08230","08300","08310","11040","11280","11350","11400","11420","11430","11440","11450","11470","11480","11489","11490","11529","11530","11540","11550","11560","11570","11580","11820","11830","11840","11850","11860","11870","15100","15380","15800","15810","15820","15830","15840","15850","15860","15870","15900","15960","15970","15980","15990"],
            2: ["03010","03020","03103","03810","06000","06030","06050","06090","06140","06170","06300","06400","06470","06820","06850","06870","06890","06900","11300","11310","11320","11330","11340","11360","11370","11460","11520","11590","11800","11810"],
            1: ["03000","06040","06070","06080","06100","06500","06600","06700","06720","06760","06780","06800","06840","06860","06880"]
        };

        const costosZona = { 13: 90, 12: 83, 11: 76, 10: 69, 9: 68, 8: 67, 7: 65, 6: 61, 5: 56, 4: 51, 3: 49, 2: 42, 1: 35 };

        let subtotal = parseFloat("{{ $subtotal }}"); // Obtener el subtotal desde Blade
        let costoEnvio = 0; // Inicializar el costo de envío en 0

        // Función para obtener el costo de envío basado en el CP
        function obtenerCostoEnvio(codigoPostal) {
            for (const zona in zonas) {
                if (zonas[zona].includes(codigoPostal)) {
                    return costosZona[zona];
                }
            }
            return 0; // Devolver 0 si el CP no está en ninguna zona
        }

        // Evento cuando se cambia el CP
        $("input[name='codigo_postal']").on("input", function () {
            const codigoPostal = $(this).val().trim();
            costoEnvio = obtenerCostoEnvio(codigoPostal);

            if (costoEnvio === 0) {
                $("#mensaje-envio").text("Lo sentimos, no realizamos envíos a esta zona.").show();
                $("#btn-pagar").prop("disabled", true);
            } else {
                $("#mensaje-envio").hide();
                $("#btn-pagar").prop("disabled", false);
            }

            actualizarTotales();
        });

        // ✅ Aumentar cantidad con validación de stock
        $('.incrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) || 1;
            let stockMaximo = parseInt(input.data('stock')) || 1;

            if (cantidad < stockMaximo) {
                cantidad++;
                input.val(cantidad); // Actualizamos el valor del input
                actualizarCantidad(id, cantidad);
            } else {
                mostrarToast("❌ ¡No hay más stock disponible!", "error");
            }
        });

        // ✅ Disminuir cantidad con límite mínimo de 1
        $('.decrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) || 1;

            if (cantidad > 1) {
                cantidad--;
                input.val(cantidad); // Actualizamos el valor del input
                actualizarCantidad(id, cantidad);
            }
        });

        // ✅ Cambiar cantidad manualmente en el input
        $('.btn_input_cart').on('change', function () {
            let id = $(this).data('id');
            let cantidad = parseInt($(this).val()) || 1;
            let stockMaximo = parseInt($(this).data('stock')) || 1;

            if (cantidad < 1) {
                $(this).val(1);
            } else if (cantidad > stockMaximo) {
                $(this).val(stockMaximo);
                mostrarToast("❌ ¡No hay más stock disponible!", "error");
            } else {
                actualizarCantidad(id, cantidad);
            }
        });

        $(document).on("click", ".incrementar_kg, .decrementar_kg", function() {
            let input = $(this).siblings(".btn_input_cart");
            let id = input.data("id");
            let id_marca = parseInt(input.data("marca"));
            let stock = parseFloat(input.data("stock"));
            let cantidadActual = parseFloat(input.val());

            // Determinar si se incrementa o decrementa
            let isIncrement = $(this).hasClass("incrementar_kg");
            let isKg = $(this).hasClass("decrementar_kg");

            // Definir el incremento/decremento según id_marca
            let cambioCantidad = 1; // Valor por defecto

                if (id_marca == 147 || id_marca == 102) {
                    cambioCantidad = 0.5; // 500 g para estas marcas
                } else if (id_marca == 5) {
                    cambioCantidad = 1; // 1 kg
                } else {
                    cambioCantidad = 0.4; // 400 g para las demás marcas
                }

            // Calcular nueva cantidad
            let cantidad = isIncrement ? cantidadActual + cambioCantidad : cantidadActual - cambioCantidad;

            // Validaciones
            if (cantidad < cambioCantidad) return; // No bajar más del mínimo permitido
            if (cantidad > stock) return; // No superar el stock disponible

            // Asignar nueva cantidad
            input.val(cantidad.toFixed(1));

            // Enviar actualización al backend
            actualizarCantidad(id, cantidad);
        });

        // ✅ Cambiar cantidad en productos por peso
        $('.select_peso_cart').on('change', function () {
            let id = $(this).data('id');
            let cantidad = parseFloat($(this).val());
            let precioSeleccionado = $(this).find(':selected').data('precio');

            // Actualizar la vista del precio
            $('#total-' + id).text('$' + precioSeleccionado.toFixed(2));

            // Llamar AJAX para actualizar el carrito
            actualizarCantidad(id, cantidad);
        });

        // ✅ Eliminar producto del carrito
        $('.eliminar-producto').click(function () {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    mostrarToast("🗑️ Producto eliminado del carrito", "success");
                    location.reload(); // 🔄 Recargar para actualizar el carrito
                }
            });
        });

        // ✅ Función para actualizar la cantidad en el carrito vía AJAX
        function actualizarCantidad(id, cantidad) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    cantidad: cantidad
                },
                success: function (response) {
                    if (response.success) {
                        let precioTotal = response.total_producto.toFixed(2);
                        subtotal = response.subtotal; // Actualizamos el subtotal global
                        let total = response.total.toFixed(2);

                        // Actualizar precios en la vista
                        $('#total-' + id).text('$' + precioTotal);
                        $('#subtotal-carrito').text('$' + subtotal.toFixed(2));

                        // Recalcular el costo de envío cada vez que se actualiza la cantidad
                        const codigoPostal = $("input[name='codigo_postal']").val().trim();
                        costoEnvio = obtenerCostoEnvio(codigoPostal);
                        actualizarTotales();

                        mostrarToast("🛒 Carrito actualizado", "success");
                    }
                }
            });
        }

        // ✅ Función para mostrar Toast con sonido
        function mostrarToast(mensaje, tipo) {
            let audioSrc = tipo === "success"
                ? "{{ asset('assets/media/audio/save_global.mp3') }}"
                : "{{ asset('assets/media/audio/stock_insuficiente.mp3') }}";

            let audio = new Audio(audioSrc);
            audio.play();

            Swal.fire({
                toast: true,
                position: "top-end",
                icon: tipo,
                title: mensaje,
                showConfirmButton: false,
                timer: 2000
            });
        }

        // ✅ Función para actualizar los totales
        function actualizarTotales() {
            let totalFinal = subtotal + costoEnvio;

            if (totalFinal >= 1000) {
                costoEnvio = 0; // Envío gratis si el total es mayor o igual a 1000
                $('#envio-gratis').show(); // Mostrar mensaje de envío gratis
            } else {
                $('#envio-gratis').hide(); // Ocultar mensaje de envío gratis
            }

            // Actualizar el DOM con los valores correctos
            $('#subtotal-carrito').text('$' + subtotal.toFixed(2));
            $('#envio-carrito').text('$' + costoEnvio.toFixed(2));
            $('#total-carrito').text('$' + totalFinal.toFixed(2));
            $('#total_carrito').val(totalFinal.toFixed(2)); // Actualizar el valor del campo oculto
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.razon_social').select2();
        $('.cfdi').select2();
        $('.forma_pago').select2();
    });
          // Obtén los elementos
      const pickupRadio = document.getElementById("inlineRadio1");
      const domicilioRadio = document.getElementById("inlineRadio2");
      const containerPickup = document.querySelector(".container_pickup");
      const containerDomicilio = document.querySelector(".container_envioDomicilio");

      // Escucha cambios en los radios
      pickupRadio.addEventListener("change", toggleContainers);
      domicilioRadio.addEventListener("change", toggleContainers);

      // Función para alternar los contenedores
      function toggleContainers() {
          if (pickupRadio.checked) {
              containerPickup.style.display = "block";
              containerDomicilio.style.display = "none";
          } else if (domicilioRadio.checked) {
              containerPickup.style.display = "none";
              containerDomicilio.style.display = "block";
          }
      }

      $('input[name="factura"]').change(function () {
        if ($(this).val() === 'si') {
            $('#form_factura').slideDown(); // Muestra el formulario con animación
        } else {
            $('#form_factura').slideUp(); // Oculta el formulario con animación
        }
    });

</script>


@endsection
