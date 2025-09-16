@extends('welcome')

@section('ingresar')

<style type="text/css">
    .login-page,
    .register-page{
        background: linear-gradient(rgba(255, 255, 255, 0), rgb(75, 1, 104));
    }

    .login-page #black{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url(storage/plantilla/);
        background-size: cover;
        overflow: hidden;
        z-index: -1;

    }
</style>

<div id="black">

</div>

<div class="login-box">
  <div class="login-logo">
    <img src="{{ url('storage/plantilla/logo-blanco-bloque2.png') }}" class="img-responsive" style="padding: 100px 0px 0px 0px;" >
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar al Sistema</p>

    <form action="{{ route('login') }}" method="post">
        @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @error('email')

            <br>
            <div class="alert alert-danger">Error con el Email o Contraseña

            </div>
        @enderror()
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>

@endsection
