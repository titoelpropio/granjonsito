
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> SISTEMA GRANJA</title>
        <link rel="shortcut icon" href="{{asset('images/granja.png')}}">
        {!!Html::style('css/font-awesome.min.css')!!}
        {!!Html::style('css/bootstrap.min.css')!!}
        {!!Html::style('css/metisMenu.min.css')!!}
        {!!Html::style('css/sb-admin-2.css')!!}

        {!!Html::style('css/AdminLTE.min.css')!!}
        {!!Html::style('css/style.css')!!}
        {!!Html::style('css/bootstrap-datetimepicker.css')!!}

        {!!Html::script('js/jquery.min.js')!!}
        {!!Html::script('js/bootstrap.min.js')!!}
        {!!Html::style('css/toastr.css')!!}
        {!!Html::script('js/toastr.min.js')!!}
        {!!Html::style('css/bootstrap-select.min.css')!!}
        {!!Html::style('css/alertify.css')!!}
      
    </head>

    <body>

<div id="wrapper">
    <div id="page-wrapper">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" onclick="actualizar_pag()"><i class="fa fa-refresh" aria-hidden="true" title="ACTUALIZAR"></i> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="{!!URL::to('galpon')!!}">PONEDORAS</a></li>
                <li class="active"><a href="{!!URL::to('criarecria')!!}">CRIA</a></li>

                 @if(Auth::user()==null) 
                  <li class="active"><a href="{!!URL::to('cajadeposito')!!}">CAJAS</a></li>
                    @endif  
                    @if(Auth::user()!=null) 
                <li class="active"><a href="{!!URL::to('cajadeposito_admin')!!}">CAJAS</a></li>
                  @endif                 


                @if(Auth::user()!=null)                 
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="">GALPONES<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{!!URL::to('fases')!!}">REGISTRAR FASES</a></li>
                    <li><a href="{!!URL::to('vistagalpon')!!}">REGISTRAR GALPON</a></li>
                    <li><a href="{!!URL::to('edad')!!}">REGISTRAR EDAD</a></li>
                    <li><a href="{!!URL::to('alimento')!!}"> REGISTRAR ALIMENTO</a></li>
                    <li><a href="{!!URL::to('silo')!!}">REGISTRAR SILO</a></li> 
                    <li><a href="{!!URL::to('controlalimento')!!}">REGISTRAR CONTROL ALIMENTO</a></li>                      
                    <li><a href="{!!URL::to('vacuna')!!}">REGISTRAR VACUNA</a></li>     
                    <li><a href="{!!URL::to('consumo')!!}">MODIFICAR CONSUMO</a></li>    
                  </ul>
                </li>

                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="">CAJA - HUEVO<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="{!!URL::to('maple')!!}">REGISTRAR MAPLE</a></li>
                      <li><a href="{!!URL::to('tipocaja')!!}">REGISTRAR TIPO CAJAS</a></li>
                      <li><a href="{!!URL::to('tipohuevo')!!}">REGISTRAR TIPO HUEVOS</a></li> 
                      <li><a href="{!!URL::to('lista_caja')!!}">LISTA DE CAJAS</a></li>     
                      <li><a href="{!!URL::to('lista_maple')!!}">LISTA DE MAPLES</a></li>
                        <li><a href="{!!URL::to('ventacaja')!!}">VENTA DE CAJAS</a></li>
                      <li><a href="{!!URL::to('ventahuevo')!!}">VENTAS DE HUEVOS</a></li>   
                  </ul>
                </li>

              

                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="">REPORTES<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="{!!URL::to('reporteponedoras')!!}">REPORTE DE POSTURA HUEVO</a></li>                                
                      <li><a href="{!!URL::to('reportecajadiario')!!}">VENTA DE CAJAS</a></li>                                      
                      <li><a href="{!!URL::to('reportehuevodiario')!!}">VENTA DE HUEVOS DESCARTE</a></li>                                
                      <li><a href="{!!URL::to('reporte_compra')!!}">COMPRA DE ALIMENTOS</a></li>
                      <li><a href="{!!URL::to('reportebalance')!!}">BALANCE GENERAL</a></li>     
                  </ul>
                </li>
            <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="">ADMINISTRADOR<span class="caret"></span></a>
                  <ul class="dropdown-menu">                              
                      <li><a href="{!!URL::to('compra')!!}">COMPRA ALIMENTO</a></li>   
                      <li><a href="{!!URL::to('categoria')!!}">REGISTRAR GASTOS</a></li>
                      <li><a href="{!!URL::to('egreso')!!}">REGISTRAR EGRESO</a></li>
                      <li><a href="{!!URL::to('ingreso')!!}">REGISTRAR INGRESO</a></li>  
                      <li><a href="{!!URL::to('temperatura')!!}">REGISTRAR TEMPERATURA</a></li>  
                      <!--li><a href="Backup_Granja/php/">COPIA DE SEGURIDAD</a>  </li-->
                  </ul>
                </li>
                @endif 

              </ul>
               <ul class="nav navbar-nav navbar-right">
                 @if(Auth::user()==null) 
                   <li><a href="{!!URL::to('/')!!}" class="btn btn-success" style="color: white" > <i class="fa fa-user" aria-hidden="true"></i>  INICIAR </a></li>
                    @endif  
                    @if(Auth::user()!=null) 
                    <li><a href="{!!URL::to('logout')!!}" class="btn btn-danger" style="color: white"> <i class="fa fa-user" aria-hidden="true"></i>   SALIR</a></li>
                  @endif  
                </ul>
            </div>
          </div>
        </nav>
         @yield('content')
    </div>                    
</div>

  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/numerosmasdecimal.js')!!}
  {!!Html::script('js/metisMenu.min.js')!!}
  {!!Html::script('js/sb-admin-2.js')!!}
  {!!Html::script('js/alertify.js')!!}
  {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}
    </body>
</html>
