<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE GALPON</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet"  >
</head>

<body>
      @foreach($galpon as $gal)
        <?php if ( $gal->sw == 0): ?>
            <h2 id="nombre" align="center">RENDIMIENTO DE TODOS LOS GALPONES</h2>

        <?php else: ?>
            <h2 id="nombre" align="center">RENDIMIENTO DEL GALPON {{ $gal->nombre }} </h2>
        <?php endif;  break; ?>          
      @endforeach

  <table border="1">
      <tr style="background-color: #F5A9A9" align="center">
        <td><b>ETAPA</b></td>
        <td><b>GALPON</b></td>
        <td><b>FECHA INICIO</b></td>
        <td><b>MUERTAS</b></td>
        <td><b>HUEVOS</b></td>
        <td><b>POSTURA</b></td>
      </tr>

    <tbody>
      @foreach($galpon as $gal)
      <tr>        
        <td >{{ $gal->fase }}</td>
        <td >GALPON {{ $gal->nombre }}</td> 
        <td >{{ $gal->fecha_inicio }}</td>
        <td >{{ $gal->muertas }}</td>
        <td >{{ $gal->cantidad_total }}</td>
        <td >{{ $gal->postura_p }} %</td>
      </tr>
        @endforeach
    </tbody>
  </table>
  
</body>
</html>
 

 