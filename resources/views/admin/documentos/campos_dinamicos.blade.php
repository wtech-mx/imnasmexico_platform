<div class="form-group col-3 gc_cn">
    <label for="name">Tamaño Letra Especialidad TH</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_especi" name="tam_letra_especi" type="number" class="form-control" value="40" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Tamaño Letra nombre TH</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_nombre" name="tam_letra_nombre" type="number" class="form-control" value="45" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra Folio TH</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_folio" name="tam_letra_folio" type="number" class="form-control" value="15" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra Especialidad Cedula</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_espec_cedu" name="tam_letra_espec_cedu" type="number" class="form-control" value="17" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra Folio Cedula</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_foli_cedu" name="tam_letra_foli_cedu" type="number" class="form-control" value="19" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra Folio Trasero Cedula</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_foli_cedu_tras" name="tam_letra_foli_cedu_tras" type="number" class="form-control" value="25" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra listas materias</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_tira_afi" name="tam_letra_tira_afi" type="number" class="form-control" value="26" >
    </div>
</div>

<div class="form-group col-3 gc_cn">
    <label for="name">Letra credencial especialidad</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input id="tam_letra_esp_cred" name="tam_letra_esp_cred" type="number" class="form-control" value="8" >
    </div>
</div>

<div class="form-group col-6">
    <label for="name">Capitalizar Nombre *</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
        </span>
        <select name="capitalizar" id="capitalizar" class="form-select" required >
            <option value="No">Seleciona una opcion</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select>
    </div>
</div>

<div class="form-group col-6">
    <label for="name">Director o Directora</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{ asset('assets/user/icons/certificate.png') }}" alt="" width="30px">
        </span>
        <select name="firma_directora" id="firma_directora" class="form-select" required>
            <option value="No">Selecciona una opción</option>
            <option value="Firma del Director">Firma del Director</option>
            <option value="Firma de la Directora">Firma de la Directora</option>
            <option value="Personalizado">Personalizado</option>
        </select>
    </div>
</div>

<!-- Campo personalizado que se muestra dinámicamente -->
<div class="form-group col-12 mt-3" id="inputPersonalizado" style="display: none;">
    <label for="personalizado_texto">Texto Personalizado de Firma 1</label>
    <input type="text" name="texto_firma_personalizada" class="form-control" placeholder="Ingrese el texto personalizado">
</div>

<!-- Campo personalizado que se muestra dinámicamente -->
<div class="form-group col-12 mt-3" id="inputPersonalizado_2" style="display: none;">
    <label for="personalizado_texto">Texto Personalizado de Firma 2</label>
    <input type="text" name="texto_firma_personalizada2" class="form-control" placeholder="Ingrese el texto personalizado">
</div>


<div class="form-group col-3 gc_cn">
    <label for="name">Promedio</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
            <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
        </span>
        <input  name="promedio" type="text" class="form-control" value="9.5" >
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectFirma = document.getElementById('firma_directora');
        const inputPersonalizado = document.getElementById('inputPersonalizado');
        const inputPersonalizado2 = document.getElementById('inputPersonalizado_2');

        selectFirma.addEventListener('change', function () {
            if (this.value === 'Personalizado') {
                inputPersonalizado.style.display = 'block';
                inputPersonalizado2.style.display = 'block';
            } else {
                inputPersonalizado.style.display = 'none';
                inputPersonalizado2.style.display = 'block';
            }
        });
    });
</script>
