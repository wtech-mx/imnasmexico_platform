<div class="modal fade" id="estatusModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cambio de Estatus #
            @if ($item->folio == null){{ $item->id }}@else{{ $item->folio }}@endif
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="{{ route('notas_cotizacion.update_estatus', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                    <div class="row">
                        <div class="form-group">
                            <label for="name">Estatus *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block estatus-cotizacion"  data-toggle="select" id="estatus_cotizacion" name="estatus_cotizacion" value="{{ old('estatus_cotizacion') }}" required>
                                    <option value="">Seleccionar Estatus</option>
                                    {{-- <option value="Pendiente">Pendiente</option> --}}
                                    <option value="Aprobada">Aprobada</option>
                                    <option value="Cancelada">Cancelar</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 estado-select" style="display: none;">
                            <label for="name">Estados*</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block" data-toggle="select" id="estado" name="estado"required>
                                    <option value="">Seleciona Estado</option>
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
                                <select class="form-select d-inline-block metodo-pago" data-toggle="select" id="metodo_pago" name="metodo_pago" required>
                                    <option value="">Selecciona una opcion</option>
                                    <option value="Envio">Envio</option>
                                    <option value="Contra Entrega">Contra Entrega</option>
                                    <option value="Reposicion">Reposicion</option>
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

                        <div class="form-group col-12 metodo-pago-rep-select" style="display: none;">
                            <div class="form-group col-12">
                                <label for="name">Doc Guia</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="file" id="guia_rep" name="guia_rep">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="name">Comentario</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="text" id="comentario_rep" name="comentario_rep">
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

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
                    // Mostrar los campos relacionados con el envío
                    $modal.find('.metodo-pago-select').show();
                    $modal.find('.metodo-pago-entrega-select').hide();
                    $modal.find('.metodo-pago-rep-select').hide();

                    // Hacer los campos de imagen requeridos
                    $modal.find('#foto_pago').attr('required', true);
                    $modal.find('#doc_guia').attr('required', true);

                    // Remover el atributo required de los campos de "Contra Entrega"
                    $modal.find('#fecha_entrega').removeAttr('required');
                    $modal.find('#direccion_entrega').removeAttr('required');
                    $modal.find('#guia_rep').removeAttr('required');
                    $modal.find('#comentario_rep').removeAttr('required');

                    // Limpiar los valores de los campos de "Contra Entrega"
                    $modal.find('#fecha_entrega, #direccion_entrega, #guia_rep, #comentario_rep').val('');

                } else if (selectedValue === 'Contra Entrega') {
                    // Mostrar los campos relacionados con la entrega contra entrega
                    $modal.find('.metodo-pago-entrega-select').show();
                    $modal.find('.metodo-pago-select').hide();
                    $modal.find('.metodo-pago-rep-select').hide();

                    // Hacer los campos de fecha y dirección requeridos
                    $modal.find('#fecha_entrega').attr('required', true);
                    $modal.find('#direccion_entrega').attr('required', true);

                    // Remover el atributo required de los campos de imagen
                    $modal.find('#foto_pago').removeAttr('required');
                    $modal.find('#doc_guia').removeAttr('required');
                    $modal.find('#guia_rep').removeAttr('required');
                    $modal.find('#comentario_rep').removeAttr('required');

                    // Limpiar los valores de los campos de "Envio"
                    $modal.find('#foto_pago, #doc_guia, #guia_rep, #comentario_rep').val('');
                } else if (selectedValue === 'Reposicion') {
                    // Mostrar los campos relacionados con la entrega Reposicion
                    $modal.find('.metodo-pago-rep-select').show();
                    $modal.find('.metodo-pago-entrega-select').hide();
                    $modal.find('.metodo-pago-select').hide();

                    // Hacer los campos de fecha y dirección requeridos
                    $modal.find('#guia_rep').attr('required', true);
                    $modal.find('#comentario_rep').attr('required', true);

                    // Remover el atributo required de los campos de imagen
                    $modal.find('#foto_pago').removeAttr('required');
                    $modal.find('#doc_guia').removeAttr('required');
                    $modal.find('#fecha_entrega').removeAttr('required');
                    $modal.find('#direccion_entrega').removeAttr('required');

                    // Limpiar los valores de los campos de "Envio"
                    $modal.find('#foto_pago, #doc_guia, #fecha_entrega, #direccion_entrega').val('');
                }
            }).trigger('change'); // Activar el evento para el valor actual.
        });
    });
    </script>
