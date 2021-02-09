@extends('layouts.plantilla')
@section('titulo')
    Servicios
@endsection

@section('contenido')
<div class="container">
    <div class="card mt-5 border-none shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">

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

            @if (session('mensaje2'))
                <script>
                    Swal.fire(
                    'Exito!',
                    '{{ session ('mensaje2')}}',
                    'success'
                    )
                </script>
            @endif
          <div class="">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                Registrar Servicio
              </button>
              <div class="mt-3 table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead class="bg-dark text-light">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">TIPO DE SERVICIO</th>
                        <th scope="col">IMAGEN</th>
                        <th scope="col">OPSIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $num=0; ?>
                        @foreach ($servicios as $servicio)
                        <?php $num++; ?>
                            <tr class="accordion-toggle">
                                <th>{{ $servicio->id }}</th>
                                <td>{{ $servicio->nombre }}</td>
                                <td>{{ $servicio->nombreTipoServicio }}</td>
                                <td><img src="{{ asset('storage/'.$servicio->foto) }}" width="80px" alt="..."></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <button type="button" class="btn btn-sm btn-icon btn-round btn-primary mx-2" data-toggle="modal" data-target="#editar<?=$num?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        @include('servicios.editar')
                                        {{-- <button type="submit" class="btn btn-sm btn-icon btn-round btn-danger" onclick="alert('Al eliminar registro no podras recuperarlo, estas seguro que deseas eliminarlo?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>

            @include('servicios.registrar')
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




