<nav>
    <div class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-doc-perso-tab" data-bs-toggle="tab" data-bs-target="#nav-doc-perso" type="button" role="tab" aria-controls="nav-doc-perso" aria-selected="true">
                Doc. Personal
            </button>

            <button class="nav-link" id="nav-des-sub-doc-tab" data-bs-toggle="tab" data-bs-target="#nav-des-sub-doc" type="button" role="tab" aria-controls="nav-des-sub-doc" aria-selected="false">
                Descargas/Subir Documentos Para SEP CONOCER
            </button>

            @foreach ($estandaresComprados as $estandar)
                @if ($estandar->nombre == 'EC0010 - Prestación de Servicios Estéticos Corporales SEP CONOCER')
                    <button class="nav-link" id="nav-des-ejemplo-tab" data-bs-toggle="tab" data-bs-target="#nav-des-ejemplo" type="button" role="tab" aria-controls="nav-des-ejemplo" aria-selected="false">
                        Ejemplos de llenado SEP CONOCER
                    </button>
                @elseif($estandar->nombre == 'EC0186 - Gestión del negocio spa SEP CONOCER')
                    <button class="nav-link" id="nav-des-ejemplo-tab-spa" data-bs-toggle="tab" data-bs-target="#nav-des-ejemplo-spa" type="button" role="tab" aria-controls="nav-des-ejemplo-spa" aria-selected="false">
                        Ejemplos de llenado SPA SEP CONOCER
                    </button>
                @endif
            @endforeach

            <button class="nav-link" id="nav-estan-doc-tab" data-bs-toggle="tab" data-bs-target="#nav-estan-doc" type="button" role="tab" aria-controls="nav-estan-doc" aria-selected="false">
                Guia Estandar
            </button>
        </div>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent" style="">

    <div class="tab-pane fade show active" id="nav-doc-perso" role="tabpanel" aria-labelledby="nav-doc-perso-tab" tabindex="0" style="min-height: auto!important;">
        @include('user.components.profile.tab_doc_personales')
    </div>

    <div class="tab-pane fade" id="nav-des-sub-doc" role="tabpanel" aria-labelledby="nav-des-sub-doc-tab" tabindex="0" style="min-height: auto!important;">
        @include('user.components.profile.tab_estandares')
    </div>

    @foreach ($estandaresComprados as $estandar)
        @if ($estandar->nombre == 'EC0010 - Prestación de Servicios Estéticos Corporales SEP CONOCER')
            <div class="tab-pane fade" id="nav-des-ejemplo" role="tabpanel" aria-labelledby="nav-des-ejemplo-tab" tabindex="0" style="min-height: auto!important;">
                @include('user.components.profile.tab_ejemplo')
            </div>
        @elseif($estandar->nombre == 'EC0186 - Gestión del negocio spa SEP CONOCER')
            <div class="tab-pane fade" id="nav-des-ejemplo-spa" role="tabpanel" aria-labelledby="nav-des-ejemplo-tab-spa" tabindex="0" style="min-height: auto!important;">
                @include('user.components.profile.tab_ejemplo_spa')
            </div>
        @endif
    @endforeach

    <div class="tab-pane fade" id="nav-estan-doc" role="tabpanel" aria-labelledby="nav-estan-doc-tab" tabindex="0" style="min-height: auto!important;">
        @include('user.components.profile.tab_estandarDoc')
    </div>

</div>

