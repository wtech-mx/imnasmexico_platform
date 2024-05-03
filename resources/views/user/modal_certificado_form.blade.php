<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario</h1>
        </div>
        <form role="form" action="{{ route('perfil.formulario', $cliente->code) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body row">

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Nombre *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/letter.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="nombre" required>
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Apellidos *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/letter.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="apellido" required>
                    </div>
                </div>

                <div class="mb-4 col-12">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Profesion *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/MEDICOS.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="puesto" required>
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Edad *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/grupo-de-edad.png')}}" style="width: 40px"></span>
                    <input type="number" class="form-control" name="edad" required>
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Ciudad  *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/rascacielos.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="city" required>
                    </div>
                </div>

                <div class="mb-4 col-12">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Especialidad de curso que imparten *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/read.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="especialidad" required>
                    </div>
                </div>

                <div class="mb-4 col-12">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Sector de productividad a la que se dedican *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/carta.png')}}" style="width: 40px"></span>
                    <input type="text" class="form-control" name="sector_productividad" required>
                    </div>
                </div>

                <div class="mb-4 col-12">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">De que manera imparten cursos  *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/maestro.png')}}" style="width: 40px"></span>
                    <select name="manera_cursos" id="manera_cursos" class="form-select" required>
                        <option value="Tengo mi propia escuela">Tengo mi propia escuela</option>
                        <option value="Soy independiente">Soy independiente</option>
                    </select>
                    </div>
                </div>

                <div class="mb-4 col-12">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Como impartes los cursos *</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/meeting.webp')}}" style="width: 40px"></span>
                    <select name="modalidad_cursos" id="modalidad_cursos" class="form-select" required>
                        <option value="Online">Online</option>
                        <option value="Presencial">Presencial</option>
                    </select>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar para corregir mis documentos cargados</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
