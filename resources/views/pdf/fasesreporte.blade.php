<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE GALPON</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet"  >
</head>

<body>
<?php $muertas=0; ?>
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
        <!--td><b>FECHA INICIO</b></td-->
        <td><b>MUERTAS</b></td>
      </tr>

    <tbody>
      @foreach($fase as $gal)
      <tr>        
        <td >{{ $gal->nombre }}</td>
        <td >GALPON {{ $gal->numero }}</td> 
        <!--td >{{ $gal->fecha_inicio }}</td-->
        <td >{{ $gal->total_muerta }}</td>
      </tr>
      <?php $muertas=$muertas + $gal->total_muerta; ?>      
        @endforeach
        <tr bgcolor="#CEF6F5">
          <td><FONT color="red" size="4"><b>TOTAL</b></FONT></td>
          <td></td>         
          <td> <FONT color="red" size="4"><b><?php  echo $muertas ?></FONT> </td>          
        </tr>
    </tbody>
  </table>
  
</body>
</html>
 

 