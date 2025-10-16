@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gestor de Usuarios</h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <button class="btn btn-primary" data-toggle="modal"
                    data-target="#modalCrearUsuario">Agregar Usuario</button>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover dt-responsive">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Sucursal</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Ultimo Login</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $key => $user )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->foto != '')
                                            <img src="{{ url('storage/'.$user->foto) }}" class="img-thumbnail" width="40px">
                                        @else
                                            <img src="{{ url('storage/users/anonymous.png') }}" class="img-thumbnail" width="40px">
                                        @endif
                                    <td>{{ $user->cod_sucursal }}</td>
                                    <td>{{ $user->rol }}</td>
                                    <td>
                                        @if ($user->status == 'Activo')
                                            <button class="btn btn-success btn-xs">Activo</button>
                                        @else
                                            <button class="btn btn-danger btn-xs">Inactivo</button>
                                        @endif
                                    </td>
                                    <td>{{ $user->ultimo_login }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalCrearUsuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    @csrf
                    <div class="modal-header" style="background: #6e388d; color: white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Usuario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control input-lg" name="name" placeholder="Ingrese Nombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control input-lg" name="email" placeholder="Ingrese el email" required>
                                </div>
                                @error('email')
                                    <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-lg" name="password" placeholder="Ingrese la contraseña" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    <select class="form-control input-lg selectRol" name="rol" >
                                        <option value="">Selecionar Rol</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Encargado">Encargado</option>
                                        <option value="Cajero">Cajero</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group selectSucursal" style="display:none">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                     <select class="form-control input-lg" name="cod_sucursal" >
                                        <option value="">Selecionar Sucursal</option>
                                        @foreach ( $sucursales as $sucursal )
                                            <option value="{{ $sucursal->cod_sucursal }}">{{ $sucursal->name }}</option>
                                        @endforeach
                                    </select>
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
@endsection
