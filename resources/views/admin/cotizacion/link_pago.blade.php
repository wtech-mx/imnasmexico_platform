<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Link de Pago NAS #{{ $nota->folio }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="google-site-verification" content="xjOUgezOv03ht4XdfShswB0Hh-49H_WsaM6Cx9GIR6A" />

    <!-- Bootstrap -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}">

     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/twitter-bootstrap.css') }}">

    <!-- css custom -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/ecommerce.css') }}">

    <!-- Sweetalert2 -->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">


    @yield('css_custom')

    <style>
        .titulo{
            font-size: 20px;
            line-height: 25px;
        }
        .subtitle{
            font-size: 16px;
            line-height: 20px;
            color: rgba(0, 0, 0, .55);
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 19px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .strong_ticket{
            font-weight: 500;
        }

        .ticket_text{
            font-weight: 300;
        }


        .bi-share::before {
            content: "\f52e";
            font-size: 14px;
        }

        .compra_prote{
            background: #00a650;
            color: #fff;
            font-size: 9px;
            border-radius: 10px;
            padding: 4px;
        }

        .bi-shield::before {
            content: "\f53f";
            font-size: 13px;
        }

        .bi-cart::before {
            content: "\f242";
            font-size: 15px;
        }

        .btn_compra{
            background-color: #3483fa;
            border: none;
            border-radius: 13px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

    </style>

</head>

    <body style="background:#f9f4f4">
    <section class="d-flex justify-content-center align-items-start" style="min-height:100vh; background: #3483fa;">
        <div class="card p-3 mt-3 mb-5" style="max-width: 375px; width:100%;">

            {{-- — Header del ticket — --}}
            <div class="d-flex justify-content-between mb-2">
                <div class="text-center"><strong class="strong_ticket text-center">
                    Folio: <br> </strong> {{ $nota->folio }}
                </div>
                    {{-- — Compartir por WhatsApp — --}}
                    <div class="text-center mb-4">
                        @php
                            // Preparamos el mensaje con la URL actual
                            $shareUrl = Request::fullUrl();
                            $message  = urlencode("Revisa tu Link de pago: $shareUrl");
                        @endphp
                        <a
                            href="https://api.whatsapp.com/send?text={{ $message }}"
                            target="_blank"
                            class="btn btn-success"
                            style="background-color:transparent; border:none;font-size: 3px;"
                        >
                        <i class="icons_header bi bi-share" style="color:#000"></i>
                        </a>
                    </div>
                <div class="text-center"><strong class="strong_ticket text-center">
                    Fecha: <br> </strong> {{ date('d/n/Y', strtotime($nota->fecha)) }}
                </div>
            </div>

            {{-- — Total del pago — --}}
            <div class="text-center mb-2">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('ecommerce/logo_nas.png') }}" style="width: 90px">
                    <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" style="width: 130px">
                </div>
            </div>
            <h5>Link de pago</h5>
                <div class="d-flex justify-content-center" >
                    <p class="compra_prote">COMPRA PROTEGIDA <i class="icons_header bi bi-shield" style="color:#fff"></i></p>
                </div>
            <h2>${{ number_format($nota->total,2) }}</h2>
            </div>

            <div class="d-flex justify-content-center" >
                <form method="POST" action="{{ route('link_pago.process-payment') }}">
                    @csrf
                    <input type="text" name="total" value="{{ $nota->total }}" hidden>
                    <input type="text" name="folio" value="{{ $nota->folio }}" hidden>
                    <button type="submit" class="btn btn-success btn_compra mb-4" style="background-color:#3483fa; border:none;">
                        <i class="bi bi-cart"></i> Comprar ahora
                    </button>
                </form>
            </div>
            {{-- — Productos por Kit — --}}
            @foreach(range(1,6) as $i)
            @php
                $kitId       = 'id_kit' . ($i==1 ? '' : $i);
                $kitCantidad = 'cantidad_kit' . ($i==1 ? '' : $i);
            @endphp

            @if($nota->$kitId)
                @php
                $kit      = \App\Models\Products::find($nota->$kitId);
                $qty      = $nota->$kitCantidad;
                $unit     = $kit->precio_normal;
                $subtotal = $unit * $qty;
                @endphp

                <div class="border-top pt-2 mb-2">
                <div class="d-flex justify-content-between">
                    <div><strong class="strong_ticket">{{ $kit->nombre }}</strong> </div>
                    <div><strong class="strong_ticket">x</strong> {{ $qty }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="ticket_text">${{ number_format($unit,2) }}/u</div>
                    <div><strong class="strong_ticket">${{ number_format($subtotal,2) }}</strong></div>
                </div>
                @if($kit->bundleItems->count())
                    <ul class="small mb-0">
                    @foreach($kit->bundleItems as $item)
                        <li>{{ $item->cantidad }} × {{ $item->producto }}</li>
                    @endforeach
                    </ul>
                @endif
                </div>
            @endif
            @endforeach

            {{-- — Productos sueltos — --}}
            @foreach($nota_productos->where('kit',0) as $prod)
            @php
                $unit  = $prod->price  ?: $prod->Productos->precio_normal;
                $total = $prod->total ?: $unit * $prod->cantidad;
            @endphp

            <div class="border-top pt-2 mb-2">
                <div class="d-flex justify-content-between">
                <div><strong class="strong_ticket">{{ $prod->producto }}</strong></div>
                <div>x {{ $prod->cantidad }}</div>
                </div>
                <div class="d-flex justify-content-between">
                <div class="ticket_text">${{ number_format($unit,2) }}/u</div>
                <div><strong class="strong_ticket">${{ number_format($total,2) }}</strong></div>
                </div>
            </div>
            @endforeach

            {{-- — Resumen de Totales — --}}
            <div class="border-top pt-2">
            <div class="d-flex justify-content-between mb-1">
                <div>Subtotal</div>
                <div>${{ number_format($nota->subtotal,2) }}</div>
            </div>
            @if($nota->restante > 0)
                <div class="d-flex justify-content-between mb-1">
                <div>Descuento</div>
                <div>{{ $nota->restante }}%</div>
                </div>
            @endif
            @if($nota->envio == 'Si')
                <div class="d-flex justify-content-between mb-1">
                <div>Envío</div>
                <div>${{ number_format($nota->dinero_recibido,2) }}</div>
                </div>
            @endif
            @if($nota->factura == '1')
                <div class="d-flex justify-content-between mb-1">
                <div>IVA</div>
                <div>16%</div>
                </div>
            @endif
            <div class="d-flex justify-content-between fw-bold">
                <div>Total</div>
                <div>${{ number_format($nota->total,2) }}</div>
            </div>
            </div>

        </div>
    </section>



        <!-- Bootstrap -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/bootstrap_bundle.js') }}"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/popper.js') }}"></script>

        <!-- jquery -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/jquery-3.7.0.js') }}"></script>

        <!-- Sweetalert2 -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>

        @yield('js_custom')


</body>

</html>
