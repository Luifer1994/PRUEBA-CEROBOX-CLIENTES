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
                Registrar Cliente
              </button>
              @include('clientes.registrar')
              <div class="mt-3 table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead class="bg-dark text-light">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CEDULA</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $num=0; ?>
                        @foreach ($clientes as $cliente)
                        <?php $num++; ?>
                            <tr class="accordion-toggle">
                                <th>{{ $cliente->id }}</th>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->cedula }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{ url('detalles', $cliente->id) }}" type="button" class="btn btn-sm btn-icon btn-round btn-success mx-2">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-round btn-primary mx-2" data-toggle="modal" data-target="#editar<?=$num?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <form method="POST" action="{{ route('clientes.destroy', $cliente->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-round btn-danger" onclick="alert('Al eliminar registro no podras recuperarlo, estas seguro que deseas eliminarlo?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @include('clientes.editar')
                        @endforeach
                    </tbody>
                  </table>
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




