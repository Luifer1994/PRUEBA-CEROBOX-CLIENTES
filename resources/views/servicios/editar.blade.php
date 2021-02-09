<!-- Modal -->
<div class="modal fade" id="editar<?=$num?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mx-4 my-4">

                <form method="POST" action="{{ route('servicios.update',$servicio->id) }}" enctype="multipart/form-data" class="row g-3">
                    @method('PUT')
                    @csrf
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" value="{{ $servicio->nombre }}" class="form-control" id="nombe" name="nombre" required>
                    </div>

                    <div class="col-md-6">
                        <label for="correo" class="form-label">Tipo de Servicio:</label>

                        <select id="inputState" name="tipoServicio" class="form-control">
                            <option selected>Seleccione...</option>

                            @foreach ($tipoServicios as $tipoServicio)
                            <option value="{{ $tipoServicio->id }}" {{ ($servicio->id_tipo_servicio == $tipoServicio->id) ? 'selected' : '' }}>{{ $tipoServicio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Imagen:</label>
                        <input type="file"  value="{{ $servicio->imagen }}" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <h6>Imagen actual</h6>
                        <img src="{{ asset('storage/'.$servicio->foto) }}" width="80px" alt="...">
                    </div>
                    <div class="mt-3 mx-3 col-md-12">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cacelar</button>
                    </div>
                </form>

            </div>
        </div>
      </div>
    </div>
  </div>


