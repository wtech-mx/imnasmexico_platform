<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12">
            <h2 class="titulo_alfa mt-3 mb-5 text-center" style="color: #fff!important">
                Nuestro Catálogo
            </h2>
        </div>

        <div class="col-12 m-auto mb-5">

            <div class="owl-carousel owl-theme">
                {{-- @foreach ($resultados as $resultado)
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product">{{ $resultado->categories[0]->name }}</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        @if (!empty($resultado->images))
                                        <img src="{{ url($resultado->images[0]->src) }}" alt="{{$resultado->name}}" class="img_slider_product">
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">{{$resultado->name}}</p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="{{ $resultado->permalink }}">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach --}}
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/SILICIO-PLUS-LM.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Silicio Plus</p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/gel-silicio-plus-125-ml/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/SILICIO-FORTE.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Silicio Forte </p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/silicio-forte-250g/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/PERLAS-MARINAS.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Perlas Marina </p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/perlas-marinas-spa-1-3kg/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/86-FANGO-EXOTIC-CON-ORO.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Fango Exotic</p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/fango-exotic-con-oro-y-acido-hialuronico-1300g/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/53-SUN-PROTECTOR-GEL.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Sun protector</p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/sun-protector-gel-125ml/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="">
                    <div class="content_careder_products">
                        <div class="card card_slider_products" style="">
                            <div class="d-flex justify-content-center">
                                <h4 class="text-left ttile_categoria_product"></h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="contenedor_img_slider_product tamano_1">
                                    <p class="text-center">
                                        <img src="{{asset('productos/35-ACNEYING.png')}}" alt="Argán oil" class="img_slider_product">
                                    </p>
                                </div>
                            </div>

                            <div class="card-body space_productos_slider">
                                <div class="card-title">
                                    <p class="text-center tittle_product_slider mb-4">Acneying</p>

                                    <p class="text-center">
                                        <a class="text-center btn_slider_product mb-3" href="https://imnasmexico.com/new/producto/acneying-250g/">Compra</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
