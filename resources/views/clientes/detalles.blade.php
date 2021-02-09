@extends('layouts.plantilla')
@section('titulo')
    Clientes
@endsection

@section('contenido')
{{-- ERROR DE VALIDACION DE CAMPOS Y MUESTRA UNA ALERTA DE QUE HAY CAMPOS VAVIOS --}}
@if ($errors->any())
<script>
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Error hay campos vacios revisa el Formulario!',
    })
</script>
@endif

 @if (session('mensaje'))
    <script>
        Swal.fire(
        'Exito!',
        '{{ session ('mensaje')}}',
        'success'
        )
    </script>
@endif

<div class="container">
    <div class="card mt-5 border-none shadow  mb-5 bg-white rounded">
        <div class="card-header bg-dark text-light text-center shadow-sm p-3 mb-5 rounded">
            <h4>Detalles del Cliente</h4>
        </div>
        <div class="card-body">
          <div class="">
            <img src="{{ asset('storage/'.$cliente->imagen) }}" class="rounded mx-auto d-block img-fluid" width="170px" alt="...">
            <div class="text-center mt-3">
                <h5>{{ $cliente->nombre }}</h5>
                <h6>CC:{{ $cliente->cedula }}</h6>
                <h6>Correo: {{ $cliente->email }}</h6>
                <h6>Celular: {{ $cliente->celular }}</h6>

                    <h5 class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        Lista de observaciones
                    </h5>
                    <h5 class="btn btn-warning" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                        Servicios contratados
                    </h5>

                  <div class="row mb-3">
                    <div class="col">
                      <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                          {{ $cliente->observaciones }}
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                                Asignar nuevo servicio
                            </button>
                            @include('clientes.asignar')
                        </div>

                        <table class="table table-striped table-hover mt-4" id="example">
                            <thead class="bg-dark text-light">
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">FECHA INICIAL</th>
                                <th scope="col">FECHA FINAL</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $num=0; ?>
                                @foreach ($servicioClientes as $servicioCliente)
                                <?php $num++; ?>
                                    <tr class="accordion-toggle">
                                        <th>{{ $servicioCliente->id }}</th>
                                        <td>{{ $servicioCliente->nombreServicio }}</td>
                                        <td>{{ $servicioCliente->fecha_inicio }}</td>
                                        <td>{{ $servicioCliente->fecha_final }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>



@endsection

@section('js')

<script>
    $('#example').DataTable({
        responsive:true,
        autoWidth: false,

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            },
        }
    });
</script>

@endsection




