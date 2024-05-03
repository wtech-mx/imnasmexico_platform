<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">

            <div class="mb-4 col-6">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Nombre *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/letter.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-6">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Apellidos *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/letter.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-12">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Profesion *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/MEDICOS.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-6">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Edad *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/grupo-de-edad.png')}}" style="width: 40px"></span>
                  <input type="number" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-6">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Ciudad  *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/rascacielos.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-12">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Especialidad de curso que imparten *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/read.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-12">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Sector de productividad a la que se dedican *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/carta.png')}}" style="width: 40px"></span>
                  <input type="text" class="form-control" name="ine">
                </div>
            </div>

            <div class="mb-4 col-12">
                <label for="basic-url" class="form-label" style="font-weight: 700;">De que manera imparten cursos  *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/maestro.png')}}" style="width: 40px"></span>
                  <select name="" id="" class="form-select">
                    <option value="">Tengo mi propia escuela</option>
                    <option value="">Soy independiente</option>
                  </select>
                </div>
            </div>

            <div class="mb-4 col-12">
                <label for="basic-url" class="form-label" style="font-weight: 700;">Como impartes los cursos *</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/meeting.webp')}}" style="width: 40px"></span>
                  <select name="" id="" class="form-select">
                    <option value="">Online</option>
                    <option value="">Presencial</option>
                  </select>
                </div>
            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
