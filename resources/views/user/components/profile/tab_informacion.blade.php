<div class="row">
    <div class="col-12 col-xl-7">
        <div class="row">
            <div class="col-12">
                <h2 class="title_curso mb-5">Datos de cliente</h2>
            </div>
            <form role="form" action="{{ route('perfil.update', $cliente->code) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="row">
                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/usuario.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="name" name="name" value="{{$cliente->name}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/email.png')}}" alt="">
                        </span>

                        <input class="form-control" type="email"  id="email" name="email" value="{{$cliente->email}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/ring-phone.png')}}" alt="">
                        </span>

                        <input class="form-control" type="number"  id="telefono" name="telefono" value="{{$cliente->telefono}}">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h2 class="title_curso mb-5">Datos de Facturación</h2>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/document.png')}}" alt="">
                            </span>
                            <select name="cfdi" id="cfdi" style="width: 160px;">
                                <option value="{{$cliente->cfdi}}">{{$cliente->cfdi}}</option>
                                <option value="G01 Adquisición de Mercancías">G01 Adquisición de Mercancías</option>
                                <option value="G02 Devoluciones, Descuentos o bonificaciones">G02 Devoluciones, Descuentos o bonificaciones</option>
                                <option value="G03 Gastos en general">G03 Gastos en general</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/document.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="rfc" name="rfc" placeholder="RFC" value="{{$cliente->rfc}}">
                        </div>
                    </div>

                    <div class="col-6 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/user.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="razon_social" name="razon_social" placeholder="Razon Social" value="{{$cliente->razon_social}}">
                        </div>
                    </div>

                    <div class="col-6 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/location-pointer.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="direccion" name="direccion" placeholder="Direccion" value="{{$cliente->direccion}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 form-group ">
                        <button type="submit" class="btn_save_profile" >
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
