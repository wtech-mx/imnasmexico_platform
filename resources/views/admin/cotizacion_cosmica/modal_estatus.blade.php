<!-- Modal -->
<div class="modal fade" id="estatus_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="estatus_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Cambiar estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                    <form class="form row" action="{{ route('distribuidoras.update_estatus', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <h4 class="text-center">¿Cambiar estatus?</h4>

                        <div class="form-group col-12">
                            <label for="name">Estatus *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block estatus-cotizacion" data-toggle="select" name="estatus_cotizacion" value="{{ old('estatus_cotizacion') }}">
                                    <option value="">Seleccionar Estatus</option>
                                    <option value="Aprobada">Aprobada</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 estado-select" style="display: none;">
                            <label for="name">Estados*</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block" data-toggle="select" id="estado" name="estado">
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California Sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                                    <option value="Coahuila">Coahuila</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Estado de Mexico">Estado de Mexico</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="Michoacán">Michoacán</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo León">Nuevo León</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Querétaro">Querétaro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Yucatán">Yucatán</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>
                            </div>

                            <label for="name">Forma de envio*</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block metodo-pago" data-toggle="select" id="metodo_pago" name="metodo_pago">
                                    <option value="">Selecciona una opcion</option>
                                    <option value="Envio">Envio</option>
                                    <option value="Contra Entrega">Contra Entrega</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 metodo-pago-select" style="display: none;">
                            <div class="form-group col-12">
                                <label for="name">Comprobante de pago</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="file" id="foto_pago" name="foto_pago">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="name">Doc Guia</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="file" id="doc_guia" name="doc_guia">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 metodo-pago-entrega-select" style="display: none;">
                            <div class="form-group col-12">
                                <label for="name">fecha entrega</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="date" id="fecha_entrega" name="fecha_entrega">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="name">Direccion</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="text" id="direccion_entrega" name="direccion_entrega">
                                </div>
                            </div>
                        </div>



                        <div class="col-12 mt-5">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </div>
                        </div>

                    </form>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            var $modal = $(this);

            $modal.find('.estatus-cotizacion').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Aprobada') {
                    $modal.find('.estado-select').show();
                } else {
                    $modal.find('.estado-select').hide();
                }
            }).trigger('change'); // Activar el evento para el valor actual.

            $modal.find('.metodo-pago').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Envio') {
                    $modal.find('.metodo-pago-select').show();
                    $modal.find('.metodo-pago-entrega-select').hide();
                } else if (selectedValue === 'Contra Entrega') {
                    $modal.find('.metodo-pago-entrega-select').show();
                    $modal.find('.metodo-pago-select').hide();
                }
            }).trigger('change'); // Activar el evento para el valor actual.
        });
    });

</script>
