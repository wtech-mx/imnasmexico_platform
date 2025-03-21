<h4>¿Requieres factura?</h4>

<div class="row">
    <div class="col-12">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="factura" id="factura_si" value="si">
            <label class="form-check-label" for="factura_si">Sí</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="factura" id="factura_no" value="no" checked>
            <label class="form-check-label" for="factura_no">No</label>
        </div>
    </div>
</div>

<div id="form_factura" class="mt-2 border rounded" style="display: none;border: 3px transparent !important;">
    <h5 class="mt-3">Datos para la Factura</h5>
    <div class="mb-3">
        <label for="rfc" class="form-label">RFC</label>
        <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingresa tu RFC">
    </div>

    <div class="mb-3">
        <label for="rfc" class="form-label">Direccion Fiscal</label>
        <input type="text" class="form-control" id="direccion_factura" name="direccion_factura" placeholder="Ingres tu Direccion Fiscal ">
    </div>

    <div class="mb-3">
        <label for="razon_social" class="form-label">Régimen fiscal</label>
        <select class="form-select razon_social" id="razon_social" name="razon_social">
                <option selected value="601 - General de Ley de Personas Morales">
                    General de Ley de Personas Morales</option>
                <option value="603 - Personas morales con fines no lucrativos">Personas morales con fines no lucrativos</option>
                <option value="605 - Sueldos y Salarios e Ingresos Asimilados a Salarios">Sueldos y Salarios e Ingresos Asimilados a Salarios</option>
                <option value="606 - Arrendamiento">Arrendamiento</option>
                <option value="607 - Régimen de enajenación o adquisición de bienes">Régimen de enajenación o adquisición de bienes</option>
                <option value="608 - Demás ingresos">Demás ingresos</option>
                <option value="609 - Consolidación">Consolidación</option>
                <option value="610 - Residentes en el extranjero sin establecimiento permanente en México">Residentes en el extranjero sin establecimiento permanente en México</option>
                <option value="611 - Ingresos por Dividendos (socios y accionistas)">Ingresos por Dividendos (socios y accionistas)</option>
                <option value="612 - Personas físicas con actividades empresariales y profesionales">Personas físicas con actividades empresariales y profesionales</option>
                <option value="614 - Ingresos por intereses">Ingresos por intereses</option>
                <option value="615 - Régimen de los ingresos por obtención de premios">Régimen de los ingresos por obtención de premios</option>
                <option value="616 - Sin obligaciones fiscales">Sin obligaciones fiscales</option>
                <option value="620 - Sociedades Cooperativas de Producción que optan por diferir sus ingresos">Sociedades Cooperativas de Producción que optan por diferir sus ingresos</option>
                <option value="621 - Incorporación fiscal">Incorporación fiscal</option>
                <option value="622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras">Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                <option value="623 - Opcional para grupos de sociedades">Opcional para grupos de sociedades</option>
                <option value="624 - Coordinados">Coordinados</option>
                <option value="625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas">Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
                <option value="626 - Régimen Simplificado de Confianza - RESICO">Régimen Simplificado de Confianza - RESICO</option>
                <option value="628 - Hidrocarburos">Hidrocarburos</option>
                <option value="629 - De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales">De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales</option>
                <option value="630 - Enajenación de acciones en bolsa de valores">Enajenación de acciones en bolsa de valores</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="rfc" class="form-label">Uso</label>
        <select class="form-select cfdi" id="cfdi" name="cfdi">
                <option value="G01 - Adquisición de mercancías">
                    Adquisición de mercancías
                </option>
                <option value="G02 - Devoluciones, descuentos o bonificaciones">
                    Devoluciones, descuentos o bonificaciones
                </option>
                <option selected value="G03 - Gastos en general">
                    Gastos en general
                </option>
                <option value="I01 - Construcciones">
                    Construcciones
                </option>
                <option value="I02 - Mobiliario y equipo de oficina por inversiones">
                    Mobiliario y equipo de oficina por inversiones
                </option>
                <option value="I03 - Equipo de transporte">
                    Equipo de transporte
                </option>
                <option value="I04 - Equipo de cómputo y accesorios">
                    Equipo de cómputo y accesorios
                </option>
                <option value="I05 - Dados, troqueles, moldes, matrices y herramental">
                    Dados, troqueles, moldes, matrices y herramental
                </option>
                <option value="I06 - Comunicaciones telefónicas">
                    Comunicaciones telefónicas
                </option>
                <option value="I07 - Comunicaciones satelitales">
                    Comunicaciones satelitales
                </option>
                <option value="I08 - Otra maquinaria y equipo">
                    Otra maquinaria y equipo
                </option>
                <option value="D01 - Honorarios médicos, dentales y gastos hospitalarios.">
                    Honorarios médicos, dentales y gastos hospitalarios.
                </option>
                <option value="D02 - Gastos médicos por incapacidad o discapacidad">
                    Gastos médicos por incapacidad o discapacidad
                </option>
                <option value="D03 - Gastos funerarios">
                    Gastos funerarios
                </option>
                <option value="D04 - Donativos">
                    Donativos
                </option>
                <option value="D05 - Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)">
                    Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)
                </option>
                <option value="D06 - Aportaciones voluntarias al SAR">
                    Aportaciones voluntarias al SAR
                </option>
                <option value="D07 - Primas de seguros de gastos médicos">
                    Primas de seguros de gastos médicos
                </option>
                <option value="D08 - Gastos de transportación escolar obligatoria">
                    Gastos de transportación escolar obligatoria
                </option>
                <option value="D09 - Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.">
                    Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.
                </option>
                <option value="D10 - Pagos por servicios educativos (colegiaturas)">
                    Pagos por servicios educativos (colegiaturas)
                </option>
                <option value="S01 - Sin efectos fiscales">
                    Sin efectos fiscales
                </option>
        </select>
    </div>
    <div class="mb-3">
        <label for="rfc" class="form-label">Forma pago</label>
        <select class="form-select forma_pago" id="forma_pago" name="forma_pago">
                <option value="Efectivo">Efectivo</option>
                <option value="Cheque nominativo">Cheque nominativo</option>
                <option value="Transferencia electrónica de fondos">Transferencia electrónica de fondos</option>
                <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                <option value="Monedero Electrónico">Monedero Electrónico</option>
                <option value="Dinero Electrónico">Dinero Electrónico</option>
                <option value="Vales de despensa">Vales de despensa</option>
                <option value="Dación en pago">Dación en pago</option>
                <option value="Pago por subrogación">Pago por subrogación</option>
                <option value="Pago por consignación">Pago por consignación</option>
                <option value="Condonación">Condonación</option>
                <option value="Compensación">Compensación</option>
                <option value="Novación">Novación</option>
                <option value="Confusión">Confusión</option>
                <option value="Remisión de deuda">Remisión de deuda</option>
                <option value="Prescripción o caducidad">Prescripción o caducidad</option>
                <option value="A satisfacción del acreedor">A satisfacción del acreedor</option>
                <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                <option value="Tarjeta de Servicio">Tarjeta de Servicio</option>
                <option value="Aplicación de anticipos">Aplicación de anticipos</option>
                <option value="Intermediario pagos">Intermediario pagos</option>
                <option selected value="Por definir">Por definir</option>
        </select>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="desglose_fiscal">
        <label class="form-check-label">
            No hay desglose fiscal
        </label>
    </div>
</div>
