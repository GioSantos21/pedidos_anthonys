@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Sucursales</h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSucursal">Agregar Sucursal</button>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover dt-responsive">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>codigo Sucursal</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $sucursales as $sucursal )

                            @if ($sucursal->status=='Activo')
                                <tr>
                                    <td> {{ $sucursal->id }}</td>
                                    <td> {{ $sucursal->cod_sucursal }}</td>
                                    <td> {{ $sucursal->name }}</td>
                                    <td> {{ $sucursal->status }}</td>
                                    <td>
                                        <button class="btn btn-warning btnEditarSucursal" data-toggle="modal"
                                        data-target="#modalEditarSucursal" codSucursal="{{ $sucursal->id }}
                                        "><i class="fa fa-pencil"></i></button>

                                        <a href="Cambiar-Estado-Sucursal/Inactivo/{{ $sucursal->id }}">
                                            <button class="btn btn-danger">Deshabilitar</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <h2>Sucursales Deshabilitadas</h2>

                       <table class="table table-bordered table-striped table-hover dt-responsive">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>codigo Sucursal</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $sucursales as $sucursal )

                            @if ($sucursal->status=='Inactivo')
                                <tr>
                                    <td> {{ $sucursal->id }}</td>
                                    <td> {{ $sucursal->cod_sucursal }}</td>
                                    <td> {{ $sucursal->name }}</td>
                                    <td> {{ $sucursal->status }}</td>
                                    <td>
                                        <button class="btn btn-warning btnEditarSucursal" data-toggle="modal"
                                        data-target="#modalEditarSucursal" codSucursal="{{ $sucursal->id }}
                                        "><i class="fa fa-pencil"></i></button>

                                        <a href="Cambiar-Estado-Sucursal/Activo/{{ $sucursal->id }}">
                                            <button class="btn btn-success">Habilitar</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalAgregarSucursal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    @csrf
                    <div class="modal-header" style="background: #6e388d; color: white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Sucursal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <input type="text" class="form-control input-lg" name="name" placeholder="Ingrese Sucursal" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarSucursal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('Actualizar-Sucursal') }}">
                    @csrf
                    @method('put')
                    <div class="modal-header" style="background: #ffc107; color: black">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Sucursal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <input type="text" class="form-control input-lg" name="name"
                                    id="nombreEditar" required>
                                    <input type="text" class="form-control input-lg" name="id"
                                    id="idEditar" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" type="submit">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
