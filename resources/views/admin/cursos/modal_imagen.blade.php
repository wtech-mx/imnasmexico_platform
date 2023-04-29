<!-- Modal -->

<style>
.nav.nav-pills {
    background: #836262;
    color: #fff;
    align-items: start;
    min-width: 190px;
}
.nav.nav-pills .nav-link{
    color: #fff!important;
}
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header" style="background: #F5ECE4;">
          <h5 class="modal-title" id="exampleModalLabel">Seleccionar imagen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
            <span aria-hidden="true">X</span>
        </button>
        </div>
        <div class="modal-body" style="background: #F5ECE4;">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Online</button>
                  <button class="nav-link" id="v-pills-materialeso-tab" data-bs-toggle="pill" data-bs-target="#v-pills-materialeso" type="button" role="tab" aria-controls="v-pills-materialeso" aria-selected="false">Materiales O.</button>

                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Presencial</button>
                  <button class="nav-link" id="v-pills-materialesp-tab" data-bs-toggle="pill" data-bs-target="#v-pills-materialesp" type="button" role="tab" aria-controls="v-pills-materialesp" aria-selected="false">Materiales P.</button>

                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">PDF</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">

                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                    <h3>Online</h3>
                    <div class="row">
                        @foreach($fotos_online as $foto_online)
                        <div class="col-md-4">
                          <img src="{{ asset('curso/'.$foto_online->foto) }}" class="img-fluid img-thumbnail" alt="{{ $foto_online->nombre }}" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectImage('{{ $foto_online->foto }}')">
                          {{$foto_online->nombre}}
                        </div>
                        @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade show" id="v-pills-materialeso" role="tabpanel" aria-labelledby="v-pills-materialeso-tab" tabindex="0">
                    <h3>Materiales Online</h3>
                    <div class="row">
                        @foreach($fotos_materialeso as $foto_materialeso)
                        <div class="col-md-4">
                          <img src="{{ asset('curso/'.$foto_materialeso->material) }}" class="img-fluid img-thumbnail" alt="{{ $foto_materialeso->nombre }}" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectMateriales('{{ $foto_materialeso->material }}')">
                          {{$foto_materialeso->nombre}}
                        </div>
                        @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <h3>Presencial</h3>
                    <div class="row">
                        @foreach($fotos_presencial as $foto_presencial)
                        <div class="col-md-4">
                        <img src="{{ asset('curso/'.$foto_presencial->foto) }}" class="img-fluid img-thumbnail" alt="{{ $foto_presencial->nombre }}" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectImage('{{ $foto_presencial->foto }}')">
                        {{$foto_presencial->nombre}}
                        </div>
                        @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade show" id="v-pills-materialesp" role="tabpanel" aria-labelledby="v-pills-materialesp-tab" tabindex="0">
                    <h3>Materiales Presenciales</h3>
                    <div class="row">
                        @foreach($fotos_materialesp as $foto_materialesp)
                        <div class="col-md-4">
                          <img src="{{ asset('materiales/'.$foto_materialesp->material) }}" class="img-fluid img-thumbnail" alt="{{ $foto_materialesp->nombre }}" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectMateriales('{{ $foto_materialesp->material }}')">
                          {{$foto_materialesp->nombre}}
                        </div>
                        @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                    <h3>PDF</h3>
                    <div class="row">
                        @foreach($fotos_pdf as $foto_pdf)
                        <div class="col-md-4">
                            <iframe src="{{ asset('pdf/'.$foto_pdf->pdf) }}" width="100%" height="300" class="img-fluid img-thumbnail" data-bs-dismiss="modal" aria-label="Seleccionar" onclick="selectPdf('{{ $foto_pdf->pdf }}')">
                            </iframe>
                        {{$foto_pdf->nombre}}
                        </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
