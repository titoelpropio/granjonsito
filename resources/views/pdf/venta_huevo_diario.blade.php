<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE VENTA DE CAJAS DE HUEVOS</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet">
</head>

<body>
    <center><h1>REPORTE VENTA DE HUEVOS </h1>
    <h2> DEL {{$fech}} </h2></center>
    <table border="1">
            <tr style="background-color: #F5A9A9" align="center">
              <td><B>TIPO DE HUEVO</B></td>
              <td><B>CANTIDAD DE MAPLES</B></td>
              <td><B>SALDO</B></td>
            </tr>
        <tbody>
              @foreach($venta_huevo as $ven)
              <?php if ($ven->tipo != "total") {?>
              <tr> 
                <td >{{ $ven->tipo }}</td> 
                <td >{{ $ven->cantidad }}</td>
                <td >{{ $ven->total }} Bs.</td>
             <?php } else {  ?> 
             <tr style='background-color: #A9F5F2'>
                <td><FONT color="red" size="5"> <b>TOTAL</b></FONT></td><td></td>
                <td> <FONT color="red" size="5"><b>{{ $ven->total }} Bs.</b></FONT> </td>
              <?php } ?> 
              </tr>
              @endforeach
        </tbody>
    </table>
</body>
</html>