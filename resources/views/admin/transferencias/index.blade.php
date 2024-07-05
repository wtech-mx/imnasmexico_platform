@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('trasnferencias.store') }}" enctype="multipart/form-data" role="form">
                            @csrf

                            <div class="row">

                                <div class="col-6">
                                    <label for="">Tipo de Criterio</label>
                                    <select class="form-select" name="tipoCriterio" id="">
                                        <option value="T">Clave de Rastreo</option>
                                        <option value="R">Referencia Numerica</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="">Criterio (Numero de referencia)</label>
                                        <input class="form-control" type="number" name="criterio">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="">fecha</label>
                                    <input class="form-control" type="date" name="fecha">
                                </div>

                                <div class="col-6 mt-3">
                                    <label for="">Emisor</label>
                                    <select name="emisor" class="form-select emisor" id="">
                                        <option value="40138">ABC CAPITAL</option>
                                        <option value="40133">ACTINVER</option>
                                        <option value="40062">AFIRME</option>
                                        <option value="90706">ARCUS</option>
                                        <option value="90659">ASP INTEGRA OPC</option>
                                        <option value="40128">AUTOFIN</option>
                                        <option value="40127">AZTECA</option>
                                        <option value="37166">BaBien</option>
                                        <option value="40030">BAJIO</option>
                                        <option value="40002">BANAMEX</option>
                                        <option value="40154">BANCO COVALTO</option>
                                        <option value="37006">BANCOMEXT</option>
                                        <option value="40137">BANCOPPEL</option>
                                        <option value="40160">BANCO S3</option>
                                        <option value="40152">BANCREA</option>
                                        <option value="37019">BANJERCITO</option>
                                        <option value="40147">BANKAOOL</option>
                                        <option value="40106">BANK OF AMERICA</option>
                                        <option value="40159">BANK OF CHINA</option>
                                        <option value="37009">BANOBRAS</option>
                                        <option value="40072">BANORTE</option>
                                        <option value="40058">BANREGIO</option>
                                        <option value="40060">BANSI</option>
                                        <option value="2001">BANXICO</option>
                                        <option value="40129">BARCLAYS</option>
                                        <option value="40145">BBASE</option>
                                        <option value="40012">BBVA MEXICO</option>
                                        <option value="40112">BMONEX</option>
                                        <option value="90677">CAJA POP MEXICA</option>
                                        <option value="90683">CAJA TELEFONIST</option>
                                        <option value="90630">CB INTERCAM</option>
                                        <option value="40143">CIBANCO</option>
                                        <option value="90631">CI BOLSA</option>
                                        <option value="90901">CLS</option>
                                        <option value="90903">CoDi Valida</option>
                                        <option value="40130">COMPARTAMOS</option>
                                        <option value="40140">CONSUBANCO</option>
                                        <option value="90652">CREDICAPITAL</option>
                                        <option value="40126">CREDIT SUISSE</option>
                                        <option value="90680">CRISTOBAL COLON</option>
                                        <option value="40151">DONDE</option>
                                        <option value="90616">FINAMEX</option>
                                        <option value="90634">FINCOMUN</option>
                                        <option value="90689">FOMPED</option>
                                        <option value="90685">FONDO (FIRA)</option>
                                        <option value="90601">GBM</option>
                                        <option value="37168">HIPOTECARIA FED</option>
                                        <option value="40021">HSBC</option>
                                        <option value="40155">ICBC</option>
                                        <option value="40036">INBURSA</option>
                                        <option value="90902">INDEVAL</option>
                                        <option value="40150">INMOBILIARIO</option>
                                        <option value="40136">INTERCAM BANCO</option>
                                        <option value="90686">INVERCAP</option>
                                        <option value="40059">INVEX</option>
                                        <option value="40110">JP MORGAN</option>
                                        <option value="90653">KUSPIT</option>
                                        <option value="90670">LIBERTAD</option>
                                        <option value="90602">MASARI</option>
                                        <option value="40042">MIFEL</option>
                                        <option value="40158">MIZUHO BANK</option>
                                        <option value="90600">MONEXCB</option>
                                        <option value="40108">MUFG</option>
                                        <option value="40132">MULTIVA BANCO</option>
                                        <option value="90613">MULTIVA CBOLSA</option>
                                        <option value="37135">NAFIN</option>
                                        <option value="90638">NU MEXICO</option>
                                        <option value="90710">NVIO</option>
                                        <option value="90684">OPM</option>
                                        <option value="40148">PAGATODO</option>
                                        <option value="90620">PROFUTURO</option>
                                        <option value="40156">SABADELL</option>
                                        <option value="40014">SANTANDER</option>
                                        <option value="40044">SCOTIABANK</option>
                                        <option value="40157">SHINHAN</option>
                                        <option value="90646">STP</option>
                                        <option value="90648">TACTIV CB</option>
                                        <option value="90656">UNAGRA</option>
                                        <option value="90617">VALMEX</option>
                                        <option value="90605">VALUE</option>
                                        <option value="90608">VECTOR</option>
                                        <option value="40113">VE POR MAS</option>
                                        <option value="40141">VOLKSWAGEN</option>
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label for="">Receptor</label>
                                    <select name="receptor" class="form-select receptor" id="">
                                        <option value="40138">ABC CAPITAL</option>
                                        <option value="40133">ACTINVER</option>
                                        <option value="40062">AFIRME</option>
                                        <option value="90706">ARCUS</option>
                                        <option value="90659">ASP INTEGRA OPC</option>
                                        <option value="40128">AUTOFIN</option>
                                        <option value="40127">AZTECA</option>
                                        <option value="37166">BaBien</option>
                                        <option value="40030">BAJIO</option>
                                        <option value="40002">BANAMEX</option>
                                        <option value="40154">BANCO COVALTO</option>
                                        <option value="37006">BANCOMEXT</option>
                                        <option value="40137">BANCOPPEL</option>
                                        <option value="40160">BANCO S3</option>
                                        <option value="40152">BANCREA</option>
                                        <option value="37019">BANJERCITO</option>
                                        <option value="40147">BANKAOOL</option>
                                        <option value="40106">BANK OF AMERICA</option>
                                        <option value="40159">BANK OF CHINA</option>
                                        <option value="37009">BANOBRAS</option>
                                        <option value="40072">BANORTE</option>
                                        <option value="40058">BANREGIO</option>
                                        <option value="40060">BANSI</option>
                                        <option value="2001">BANXICO</option>
                                        <option value="40129">BARCLAYS</option>
                                        <option value="40145">BBASE</option>
                                        <option value="40012">BBVA MEXICO</option>
                                        <option value="40112">BMONEX</option>
                                        <option value="90677">CAJA POP MEXICA</option>
                                        <option value="90683">CAJA TELEFONIST</option>
                                        <option value="90630">CB INTERCAM</option>
                                        <option value="40143">CIBANCO</option>
                                        <option value="90631">CI BOLSA</option>
                                        <option value="90901">CLS</option>
                                        <option value="90903">CoDi Valida</option>
                                        <option value="40130">COMPARTAMOS</option>
                                        <option value="40140">CONSUBANCO</option>
                                        <option value="90652">CREDICAPITAL</option>
                                        <option value="40126">CREDIT SUISSE</option>
                                        <option value="90680">CRISTOBAL COLON</option>
                                        <option value="40151">DONDE</option>
                                        <option value="90616">FINAMEX</option>
                                        <option value="90634">FINCOMUN</option>
                                        <option value="90689">FOMPED</option>
                                        <option value="90685">FONDO (FIRA)</option>
                                        <option value="90601">GBM</option>
                                        <option value="37168">HIPOTECARIA FED</option>
                                        <option value="40021">HSBC</option>
                                        <option value="40155">ICBC</option>
                                        <option value="40036">INBURSA</option>
                                        <option value="90902">INDEVAL</option>
                                        <option value="40150">INMOBILIARIO</option>
                                        <option value="40136">INTERCAM BANCO</option>
                                        <option value="90686">INVERCAP</option>
                                        <option value="40059">INVEX</option>
                                        <option value="40110">JP MORGAN</option>
                                        <option value="90653">KUSPIT</option>
                                        <option value="90670">LIBERTAD</option>
                                        <option value="90602">MASARI</option>
                                        <option value="40042">MIFEL</option>
                                        <option value="40158">MIZUHO BANK</option>
                                        <option value="90600">MONEXCB</option>
                                        <option value="40108">MUFG</option>
                                        <option value="40132">MULTIVA BANCO</option>
                                        <option value="90613">MULTIVA CBOLSA</option>
                                        <option value="37135">NAFIN</option>
                                        <option value="90638">NU MEXICO</option>
                                        <option value="90710">NVIO</option>
                                        <option value="90684">OPM</option>
                                        <option value="40148">PAGATODO</option>
                                        <option value="90620">PROFUTURO</option>
                                        <option value="40156">SABADELL</option>
                                        <option value="40014">SANTANDER</option>
                                        <option value="40044">SCOTIABANK</option>
                                        <option value="40157">SHINHAN</option>
                                        <option value="90646">STP</option>
                                        <option value="90648">TACTIV CB</option>
                                        <option value="90656">UNAGRA</option>
                                        <option value="90617">VALMEX</option>
                                        <option value="90605">VALUE</option>
                                        <option value="90608">VECTOR</option>
                                        <option value="40113">VE POR MAS</option>
                                        <option value="40141">VOLKSWAGEN</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="">cuenta</label>
                                    <input class="form-control" type="number" name="cuenta" value="500362597807">
                                </div>

                                <input type="hidden" name="receptorParticipante" value="false">

                                <div class="col-12">
                                    <label for="">monto</label>
                                    <input class="form-control" type="text" name="monto">
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn mt-5" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.emisor').select2();
        $('.receptor').select2();
    });


</script>

@endsection
