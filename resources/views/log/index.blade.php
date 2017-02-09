
@extends ('layouts.admin')
@section ('content')
@include('alerts.errors')


<div class="login-box" style="border-radius:  1px medium ; border: solid black"  >
    <center><img  height="200px" src="{{asset('images/granja.PNG')}}" ></center>
    <div class="login-logo">
        <a ><b>GRANJA HIGA</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos de Acceso</p>
        {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}	
        <div class="form-group has-feedback">
            <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
            {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Usuario'])!!}

          
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" value="">
          
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">

                {!!Form::submit('Ingresar',['class'=>'btn btn-primary btn-block btn-flat'])!!}

            </div><!-- /.col -->
        </div>
        {!!Form::close()!!}
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
@endsection