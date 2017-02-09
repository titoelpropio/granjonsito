<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE GALPON</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet"  >
</head>

<body>
      @foreach($fase as $gal)
        <?php if ( $gal->sw == 0): ?>
            <h2 id="nombre" align="center">RENDIMIENTO DE TODAS LAS FASES</h2>

        <?php else: ?>
            <h2 id="nombre" align="center">RENDIMIENTO DE LA {{ $gal->nombre }} </h2>
        <?php endif;  break; ?>          
      @endforeach

  <table border="1">
      <tr style="background-color: #F5A9A9" align="center">
        <td><b>ETAPA</b></td>
        <td><b>GALPON</b></td>
        <td><b>FECHA INICIO</b></td>
        <td><b>MUERTAS</b></td>
      </tr>

    <tbody>
      @foreach($fase as $gal)
      <tr>        
        <td >{{ $gal->nombre }}</td>
        <td >GALPON {{ $gal->numero }}</td> 
        <td >{{ $gal->fecha_inicio }}</td>
        <td >{{ $gal->total_muerta }}</td>
      </tr>
        @endforeach
    </tbody>
  </table>
  
</body>
</html>
 

 