<div class="row" id="facturacionFields" style="display: none; padding-left: 1rem; margin-bottom: 1rem;">
    <div class="row">
    <div class="form-group col-12 px-2 py-1">
        <h5 class="mb-2 mt-1 text-center">Datos de facturación</h5>
    </div>

    <div class="form-group col-12 px-4 py-1" >
        <label for="name" class="text-dark mb-2">Nombre / Razon Social :</label>
        <div class="input-group ">
            <span class="input-group-text span_custom_tab" >
                <img class="icon_span_tab" src="{{ asset('assets/media/icons/fuente.webp') }}" alt="" >
            </span>
            <input id="razon_cliente" name="razon_cliente" type="text"  class="form-control input_custom_tab_dark @error('razon_cliente') is-invalid @enderror"  value="{{ old('razon_cliente') }}">
        </div>
    </div>

    <div class="form-group col-12 px-4 py-1" >
        <label for="name" class="text-dark mb-2">RFC:</label>
        <div class="input-group ">
            <span class="input-group-text span_custom_tab" >
                <img class="icon_span_tab" src="{{ asset('assets/media/icons/sat.webp') }}" alt="" >
            </span>
            <input id="rfc_cliente" name="rfc_cliente" type="text"  class="form-control input_custom_tab_dark @error('rfc_cliente') is-invalid @enderror"  value="{{ old('rfc_cliente') }}">
        </div>
    </div>

    <div class="form-group col-12 px-4 py-1" >
        <label for="name" class="text-dark mb-2">CFDI :</label>
        <div class="input-group ">
            <span class="input-group-text span_custom_tab" >
                <img class="icon_span_tab" src="{{ asset('assets/media/icons/categorias.webp') }}" alt="" >
            </span>
            <select name="cfdi_cliente" id="cfdi_cliente" class="form-select d-inline-block input_custom_tab_dark">
                <option value="" {{ old('cfdi_cliente') == '' ? 'selected' : '' }}>Seleccionar</option>
                <option value="G01" {{ old('cfdi_cliente') == 'G01' ? 'selected' : '' }}>G01 - Adquisición de mercancías</option>
                <option value="G02" {{ old('cfdi_cliente') == 'G02' ? 'selected' : '' }}>G02 - Devoluciones, descuentos o bonificaciones</option>
                <option value="G03" {{ old('cfdi_cliente') == 'G03' ? 'selected' : '' }}>G03 - Gastos en general</option>
                <option value="I01" {{ old('cfdi_cliente') == 'I01' ? 'selected' : '' }}>I01 - Construcciones</option>
                <option value="I02" {{ old('cfdi_cliente') == 'I02' ? 'selected' : '' }}>I02 - Mobiliario y equipo de oficina por inversiones</option>
                <option value="I03" {{ old('cfdi_cliente') == 'I03' ? 'selected' : '' }}>I03 - Equipo de transporte</option>
                <option value="I04" {{ old('cfdi_cliente') == 'I04' ? 'selected' : '' }}>I04 - Equipo de cómputo y accesorios</option>
                <option value="I05" {{ old('cfdi_cliente') == 'I05' ? 'selected' : '' }}>I05 - Dados, troqueles, moldes, matrices y herramientas</option>
                <option value="I06" {{ old('cfdi_cliente') == 'I06' ? 'selected' : '' }}>I06 - Comunicaciones telefónicas</option>
                <option value="I07" {{ old('cfdi_cliente') == 'I07' ? 'selected' : '' }}>I07 - Comunicaciones satelitales</option>
                <option value="I08" {{ old('cfdi_cliente') == 'I08' ? 'selected' : '' }}>I08 - Otra maquinaria y equipo</option>
                <option value="D01" {{ old('cfdi_cliente') == 'D01' ? 'selected' : '' }}>D01 - Honorarios médicos, dentales y gastos hospitalarios</option>
                <option value="D02" {{ old('cfdi_cliente') == 'D02' ? 'selected' : '' }}>D02 - Gastos médicos por incapacidad o discapacidad</option>
                <option value="D03" {{ old('cfdi_cliente') == 'D03' ? 'selected' : '' }}>D03 - Gastos funerales</option>
                <option value="D04" {{ old('cfdi_cliente') == 'D04' ? 'selected' : '' }}>D04 - Donativos</option>
                <option value="D05" {{ old('cfdi_cliente') == 'D05' ? 'selected' : '' }}>D05 - Intereses reales efectivamente pagados por créditos hipotecarios</option>
                <option value="D06" {{ old('cfdi_cliente') == 'D06' ? 'selected' : '' }}>D06 - Aportaciones voluntarias al SAR</option>
                <option value="D07" {{ old('cfdi_cliente') == 'D07' ? 'selected' : '' }}>D07 - Primas por seguros de gastos médicos</option>
                <option value="D08" {{ old('cfdi_cliente') == 'D08' ? 'selected' : '' }}>D08 - Gastos de transportación escolar obligatoria</option>
                <option value="D09" {{ old('cfdi_cliente') == 'D09' ? 'selected' : '' }}>D09 - Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones</option>
                <option value="D10" {{ old('cfdi_cliente') == 'D10' ? 'selected' : '' }}>D10 - Pagos por servicios educativos (colegiaturas)</option>
                <option value="S01" {{ old('cfdi_cliente') == 'S01' ? 'selected' : '' }}>S01 - Sin efectos fiscales</option>
            </select>
        </div>
    </div>

    <div class="form-group col-12 px-4 py-1" >
        <label for="name" class="text-dark mb-2">Regimen Fiscal :</label>
        <div class="input-group ">
            <span class="input-group-text span_custom_tab" >
                <img class="icon_span_tab" src="{{ asset('assets/media/icons/categorias.webp') }}" alt="" >
            </span>
            <select name="regimen_fiscal_cliente" id="regimen_fiscal_cliente" class="form-select d-inline-block input_custom_tab_dark">
                <option value="" {{ old('regimen_fiscal_cliente') == '' ? 'selected' : '' }}>Seleccionar</option>
                <option value="601" {{ old('regimen_fiscal_cliente') == '601' ? 'selected' : '' }}>601 - General de Ley Personas Morales</option>
                <option value="603" {{ old('regimen_fiscal_cliente') == '603' ? 'selected' : '' }}>603 - Personas Morales con Fines no Lucrativos</option>
                <option value="605" {{ old('regimen_fiscal_cliente') == '605' ? 'selected' : '' }}>605 - Sueldos y Salarios e Ingresos Asimilados a Salarios</option>
                <option value="606" {{ old('regimen_fiscal_cliente') == '606' ? 'selected' : '' }}>606 - Arrendamiento</option>
                <option value="607" {{ old('regimen_fiscal_cliente') == '607' ? 'selected' : '' }}>607 - Régimen de Enajenación o Adquisición de Bienes</option>
                <option value="608" {{ old('regimen_fiscal_cliente') == '608' ? 'selected' : '' }}>608 - Demás ingresos</option>
                <option value="610" {{ old('regimen_fiscal_cliente') == '610' ? 'selected' : '' }}>610 - Residentes en el Extranjero sin Establecimiento Permanente en México</option>
                <option value="611" {{ old('regimen_fiscal_cliente') == '611' ? 'selected' : '' }}>611 - Ingresos por Dividendos (socios y accionistas)</option>
                <option value="612" {{ old('regimen_fiscal_cliente') == '612' ? 'selected' : '' }}>612 - Personas Físicas con Actividades Empresariales y Profesionales</option>
                <option value="614" {{ old('regimen_fiscal_cliente') == '614' ? 'selected' : '' }}>614 - Ingresos por intereses</option>
                <option value="615" {{ old('regimen_fiscal_cliente') == '615' ? 'selected' : '' }}>615 - Régimen de los ingresos por obtención de premios</option>
                <option value="616" {{ old('regimen_fiscal_cliente') == '616' ? 'selected' : '' }}>616 - Sin obligaciones fiscales</option>
                <option value="620" {{ old('regimen_fiscal_cliente') == '620' ? 'selected' : '' }}>620 - Sociedades Cooperativas de Producción que optan por diferir sus ingresos</option>
                <option value="621" {{ old('regimen_fiscal_cliente') == '621' ? 'selected' : '' }}>621 - Incorporación Fiscal</option>
                <option value="622" {{ old('regimen_fiscal_cliente') == '622' ? 'selected' : '' }}>622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                <option value="623" {{ old('regimen_fiscal_cliente') == '623' ? 'selected' : '' }}>623 - Opcional para Grupos de Sociedades</option>
                <option value="624" {{ old('regimen_fiscal_cliente') == '624' ? 'selected' : '' }}>624 - Coordinados</option>
                <option value="625" {{ old('regimen_fiscal_cliente') == '625' ? 'selected' : '' }}>625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
                <option value="626" {{ old('regimen_fiscal_cliente') == '626' ? 'selected' : '' }}>626 - Régimen Simplificado de Confianza</option>
            </select>

        </div>
    </div>

    <div class="form-group col-6 px-4 py-1">
        <label class="text-dark" for="codigo_postal">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal" class="form-control input_custom_tab_dark">
    </div>

    <div class="form-group col-6 px-4 py-1">
        <label class="text-dark">Colonia</label>
        <select id="colonia" name="colonia"  class="form-control input_custom_tab_dark"></select>
    </div>

    <div class="form-group col-6 px-4 py-1">
        <label class="text-dark">Ciudad</label>
        <input type="text" id="ciudad" name="ciudad"  class="form-control input_custom_tab_dark" readonly>
    </div>

    <div class="form-group col-6 px-4 py-1">
        <label class="text-dark">Estado</label>
        <input type="text" id="estado" name="estado"  class="form-control input_custom_tab_dark" readonly>
    </div>

    <div class="form-group col-6 px-4 py-1">
        <label class="text-dark">Municipio / Alcaldía</label>
        <input type="text" id="municipio" name="municipio"  class="form-control input_custom_tab_dark" readonly>
    </div>

    <div class="form-group col-12 px-4 py-1">
        <label class="text-dark" for="direccion_cliente">Direccion</label>
        <input type="text" id="direccion_cliente" name="direccion_cliente"  class="form-control input_custom_tab_dark">
    </div>
</div>
</div>
