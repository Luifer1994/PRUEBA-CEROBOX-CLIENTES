<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Registrar Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mx-4 my-4">
                <form method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control" id="nombe" name="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cedula" class="form-label">Cedula:</label>
                        <input type="number" value="{{ old('cedula') }}" class="form-control" id="cedula" name="cedula" required>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" value="{{ old('email') }}" class="form-control" id="correo" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" value="{{ old('celular') }}" class="form-control" id="celular" name="celular" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Imagen:</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" required>
                    </div>
                    <div class="col-md-12">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea class="form-control"  id="observaciones" name="observaciones" required>{{ old('observaciones') }}</textarea>
                    </div>
                    <div class="mt-3 mx-3">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cacelar</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>


