<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Asignar sercio a {{ $cliente->nombre }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mx-4 my-4">
                <form method="POST" action="{{ route('servicio.store') }}" class="row g-3">
                    @csrf

                    <input id="id_cliente" name="id_cliente" type="hidden" value="{{ $cliente->id }}">
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Servicio:</label>

                        <select id="inputState" name="id_servicio" class="form-control">
                            <option selected>Seleccione...</option>

                            @foreach ($servicios as $servicio)
                             <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="fechaInicio" class="form-label">Fecha Inicio:</label>
                        <input type="date" value="{{ old('fechaInicio') }}" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    </div>

                    <div class="col-md-6">
                        <label for="fechaFinal" class="form-label">Fecha Final:</label>
                        <input type="date" value="{{ old('fechaFinal') }}" class="form-control" id="fechaFinal" name="fechaFinal" required>
                   </div>

                   <div class="col-md-12">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea class="form-control"  id="observaciones" name="observaciones" required>{{ old('observaciones') }}</textarea>
                    </div>

                    <div class="mt-3  col-md-12">
                        <button type="submit" class="btn btn-primary">Asignar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cacelar</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

