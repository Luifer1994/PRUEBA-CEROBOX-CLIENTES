  <div class="modal fade" id="editar<?=$num?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

                <div class="form-row">
                    <form method="POST" action="{{ route('clientes.update',$cliente->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" value="{{ $cliente->nombre }}" class="form-control" id="nombe" name="nombre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cedula" class="form-label">Cedula:</label>
                            <input type="number" value="{{ $cliente->cedula }}" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" value="{{ $cliente->email }}" class="form-control" id="correo" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="number" value="{{ $cliente->celular }}" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="form-label">Imagen:</label>
                            <input type="file"  value="{{ $cliente->imagen }}" id="imagen" name="imagen" accept="image/*">
                        </div>
                        <div class="form-group col-md-6">
                            <h6>Foto actual</h6>
                            <img src="{{ asset('storage/'.$cliente->imagen) }}" width="80px" alt="...">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" required>{{ $cliente->observaciones }}
                            </textarea>
                        </div>
                        <div class="mt-3 mx-3">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cacelar</button>
                        </div>
                    </form>
                </div>

        </div>
      </div>
    </div>
  </div>





