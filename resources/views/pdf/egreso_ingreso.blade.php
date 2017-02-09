<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE VENTA DE CAJAS DE HUEVOS</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet">
</head>

<body>
<?php $total_1=0;   $total_2=0;?> 
    <center><h1>REPORTE DE INGRESO Y EGRESO</h1>
    <h1> {{$inicio}}     /    {{$fin}}</h1></center>

<h3>EGRESO</h>
    <table border="1">
          <tr style="background-color: #F5A9A9" align="center">
            <td><B>DETALLE EGRESO</B></td>
            <td><B>SALDO</B></td>
          </tr>
        <tbody>
              @foreach($egreso as $egre)
              <tr>        
                <td >{{ $egre->detalle }}</td> 
                <td >{{ $egre->total }} Bs.</td>
              </tr>
               <?php
              $total_1=$total_1+$egre->total ?>
              @endforeach
              <tr style='background-color: #A9F5F2'>              
              </td><td><FONT color="red" size="4"> <b>TOTAL EGRESO</b></FONT></td>
                <td>
                  <FONT color="red" size="4"><b><?php echo number_format($total_1,2); ?> Bs.</b></FONT>
                </td>
              </tr>  
        </tbody>
    </table>
<br>
    <h3>INGRESO</h>
    <table border="1">
          <tr style="background-color: #F5A9A9" align="center">
            <td><B>DETALLE INGRESO</B></td>
            <td><B>SALDO</B></td>
          </tr>
        <tbody>
              @foreach($ingreso as $ingre)
              <?php if ($ingre->total!=null) {?>
              <tr>        
                <td >{{ $ingre->detalle }}</td> 
                <td >{{ $ingre->total }} Bs.</td>
              </tr>
              <?php } ?>

               <?php
              $total_2=$total_2+$ingre->total ?>
              @endforeach
              <tr style='background-color: #A9F5F2'>              
              </td><td><FONT color="red" size="4"> <b>TOTAL INGRESO</b></FONT></td>
                <td>
                  <FONT color="red" size="4"><b><?php echo number_format($total_2,2); ?> Bs.</b></FONT>
                </td>
              </tr>  
        </tbody>
    </table>
<br>
    <table border="1">
      <tr style='background-color: #CEECF5'>
        <td><FONT color="red" size="6"><b>TOTAL</b></FONT></td>
        <?php $XXX=$total_2-$total_1; ?>
        <td><FONT color="red" size="6"><b><?php echo number_format($XXX,2); ?> Bs.</b> </FONT></td>
      </tr>
    </table>
</body>
</html>
 

 