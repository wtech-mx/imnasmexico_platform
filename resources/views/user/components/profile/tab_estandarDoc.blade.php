<div class="row">
    @foreach ($estandaresComprados as $estandar)
        <div class="col-12">
                <h4 class="text-center">Guía para evaluar estándar {{ $estandar->nombre }}</h4> <br>
                @php
                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', '1')->get();
                @endphp

                <div class="row">
                    @foreach ($documentos_estandar as $documento)
                        @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                        <div class="col-4">
                            <p class="text-center ">
                                <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                    <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/><br>
                                    {{ substr($documento->nombre, 13) }}
                                </a><br>
                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            </p>
                        </div>
                        @else
                        <div class="col-4">
                            <p class="text-center mt-2">
                                <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                    <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 45px; height: 45px;"/><br>
                                    {{ substr($documento->nombre, 13) }}
                                </a><br>
                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            </p>
                        </div>
                        @endif
                    @endforeach

                    @if ($estandar->nombre == 'EC0616 - Prestación de Servicios Auxiliares de Enfermería en Cuidados Básicos y Orientación a Personas en Unidades de Atención Médica SEP CONOCER')
                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=v06BVRvXvVI" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Historia de la Enfermería en México
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=v06BVRvXvVI" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=gtAcz6VfkYk" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                ASEO Y CONFORT Uso de chata en hombre
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=gtAcz6VfkYk" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=8K1kOXVJ7wg" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                ASEO Y CONFORT Uso de chata en mujer
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=8K1kOXVJ7wg" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=uoEvPvZ624Q" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Tendidos de camas
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=uoEvPvZ624Q" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=PGaQjxZp73M" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Cómo hacer una cama hospitalaria ocupada
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=PGaQjxZp73M" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=chx-bc32vwU" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                La Reanimación Cardiopulmonar (RCP) : Primeros Auxilios
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=chx-bc32vwU" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=JX0dHdFuf5k" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Oxigenoterapia - Técnica de enfermería
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=JX0dHdFuf5k" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=F1rf1ZLIhZ8" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                TECNICA DE AMORTAJAMIENTO
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=F1rf1ZLIhZ8" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=XPONFUeQeig" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Enfermeras y turno de noche: cuidados necesarios orientados al descanso del paciente
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=XPONFUeQeig" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=v8G9mxIfEXw" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                Adrenalina (Epinefrina) en Choque anafiláctico By Dr. Zamarrón
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=v8G9mxIfEXw" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>

                        <div class="col-6 mb-5">
                            <a href="https://www.youtube.com/watch?v=UGhc8mAHrVQ" style="text-decoration: none; color: #000" target="_blank">
                                <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                BAÑO DE PACIENTE EN CAMA
                            </a><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=UGhc8mAHrVQ" style="background: #836262; border-radius: 19px;" target="_blank">
                                Ver Video
                            </a>
                        </div>
                    @endif
                </div>
        </div>
    @endforeach

    @foreach ($estandar_user as $estandar)
        @if ($estandar->Estandar)
            <div class="col-12">
                <h4 class="text-center">Guía para evaluar estándar {{ $estandar->Estandar->nombre }}</h4> <br>
                @php
                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id_estandar)->where('guia', '=', '1')->get();
                @endphp

                <div class="row">
                    @foreach ($documentos_estandar as $documento)
                        @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                        <div class="col-4">
                            <p class="text-center ">
                                <a href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                    <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/><br>
                                    {{ substr($documento->nombre, 13) }}
                                </a><br>
                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            </p>
                        </div>
                        @else
                        <div class="col-4">
                            <p class="text-center mt-2">
                                <a href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                    <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 45px; height: 45px;"/><br>
                                    {{ substr($documento->nombre, 13) }}
                                </a><br>
                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            </p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
