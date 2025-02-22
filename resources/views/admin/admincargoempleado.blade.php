@extends('layouts.admin_layout_new')
@section('title', 'Administrador de cargos Empleados')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
    {{-- Para permitir eliminar registros --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


@endsection

@section('content')


{{-- <div class="page-content p-5" id="content">
<!-- Contenido de admin empleados -->
<h2>Admin Empleados <span class="text-gray float-end">SanTrips</span></h2>
<hr> --}}


<div class="pagetitle">
    <h1>Administración de Empleados</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Administración de Empleados</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filtro</h5>
            <div class="row d-flex">

                <div class="col-12">

                <form id="formBusqueda" class="row justify-center align-items-center">
    <div class="col-md-3 col-sm-4 col-lg-3">
        <label for="estado">Estado</label>
        <div class="form-group">
            <select class="form-select default-select2" name="estado" id="estado" required>
                <option value="ACTIVO">Activo</option>
                <option value="INACTIVO">Inactivo</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 mt-3 offset-lg-1 offset-md-4">
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-secondary btn-sm mx-2" type="submit">
                <span class="d-sm-inline-block ms-1">
                    <i class="bi bi-search"></i> Buscar
                </span>
            </button>
            <button class="btn btn-primary btn-sm" id="btnNuevoRegistro" type="button">
                <span class="d-sm-inline-block ms-1">
                    <i class="bi bi-file-plus"></i> NUEVO REGISTRO
                </span>
            </button>
        </div>
    </div>
</form>

                    <br>
                </div>
                <br>
                <div class="col-12 table-container">
                    <table id="tablacargos_empleado" class="table table-hover">
                        <!-- Contenido de la tabla -->
                        <thead class="">
                        <tr>
                  
                        <th>Cargo</th>
                        <th>Sueldo</th>
                        <th>Responsabilidades</th>
                        <th>Estado</th>
                        <!-- <th>Acción</th> -->
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>


<form id="formcambiarCargo" action="" method="POST" class="form">
    <input name="codigo" value="0" type="hidden">
    <input name="estado" value="0" type="hidden">
    @csrf
</form>

<div class="modal fade" id="modalRegistroCargo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro de Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroCargo" class="row" action="" method="POST" class="form">
                    @csrf

                    <input type="hidden" id="codigo_cargo" name="codigo" value="0">

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo</label>
                            <input type="text" name="cargo" class="form-control limpiarForm" placeholder="Nombre del cargo" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="sueldo" class="form-label">Sueldo</label>
                            <input type="number" name="sueldo" class="form-control limpiarForm" placeholder="Sueldo del cargo" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="responsabilidades" class="form-label">Responsabilidades</label>
                            <textarea name="responsabilidades" id="responsabilidades" cols="30" rows="10" class="form-control-limpiarForm" placeholder="Responsabilidades del cargo"></textarea>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnProcesar">Guardar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/colreorder/2.0.0/js/colReorder.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.js"></script>

<script src="{{ asset('assets/js/cargos_empleado/cargos_empleado.js') }}"></script>


@endsection
