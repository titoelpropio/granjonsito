<h1>HOLA PDF</h1>

<table border="1" width="100%">
<thead>
	<tr>
	<th>ID</th>
	<TH>NOMBRE</TH>
	<TH>CAPACIDAD</TH>
	<TH>TIPO</TH>
	</tr>
</thead>
<TBODY  align="center">
	@foreach($galpon as $gal)
	<TR>
		<td>{{ $gal->id}}</td>
		<td>{{ $gal->nombre}}</td>		
		<td>{{ $gal->capacidad_total}}</td>
		<td>{{ $gal->tipo_galpon}}</td>
	</TR>
	@endforeach
</TBODY>
</table>