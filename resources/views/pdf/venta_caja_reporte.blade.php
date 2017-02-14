<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE VENTA DE CAJAS DE HUEVOS</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet">
</head>

<body>
    <center><h1>REPORTE VENTA DE CAJAS </h1>
    <h2> {{$inicio}}     /    {{$fin}}</h2></center>
    <table border="1">
        <tr style="background-color: #F5A9A9" align="center">
            <td><b>TIPO DE CAJA</b></td>
            <td><b>CANTIDAD DE CAJAS</b></td>
            <td><b>SALDO</b></td>
          </tr>
        <tbody>
              @foreach($venta_caja2 as $ven2)
                <?php if ($ven2->tipo!='total') { ?>
                <tr>                
                  <td>{{ $ven2->tipo }}</td> 
                  <td>{{ $ven2->cantidad }}</td>
                  <td>{{ $ven2->total }} Bs.</td>
                <?php } else { ?>
                <tr style="background-color: #A9F5F2">                
                  <td><FONT color="red" size="5"> <b>TOTAL</b></FONT></td><td></td>
                <td><FONT color="red" size="5"><b>{{ $ven2->total }} Bs.</b></FONT></td>
                <?php } ?>
              </tr>
              @endforeach
        </tbody>
    </table>
</body>
</html>
 

 