<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE VENTA DE CAJAS DE MAPLES</title>
 <link href="css/reporte.css" type="text/css" rel="stylesheet">
</head>

<body>

    <center><h1>REPORTE VENTA DE MAPLES </h1>
    <h2> {{$inicio}}     /    {{$fin}}</h2></center>
    <table border="1">
        <tr style="background-color: #F5A9A9" align="center">
            <td><B>TIPO DE HUEVO</B></td>
            <td><B>CANTIDAD DE MAPLE</B></td>
            <td><B>SALDO</center></B>
        </tr>
        <tbody>
              @foreach($venta_huevo as $ven2)
       
              <?php if ($ven2->tipo != "total") {?>
              <tr><td >{{ $ven2->tipo }}</td> 
                <td >{{ $ven2->cantidad }}</td>
                <td >{{ $ven2->total }} Bs.</td>
             <?php } else {  ?> 
                <tr style='background-color: #A9F5F2'><td><FONT color="red" size="5"> <b>TOTAL</b></FONT></td><td></td>
                <td> <FONT color="red" size="5"><b>{{ $ven2->total }} Bs.</b></FONT> </td>
              <?php } ?> 
              </tr>
              @endforeach
        </tbody>
    </table>
</body>
</html>
 

 