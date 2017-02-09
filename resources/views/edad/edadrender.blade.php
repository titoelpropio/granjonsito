 <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">						
                <th><center>EDAD</center></th>
                <th><center>CANTIDAD INICIAL</center></th>
                <th><center>CANTIDAD ACTUAL</center></th>
                <th><center>TOTAL MUERTA</center></th>
                <th><center>FECHA INGRESO</center></th>						
                <th><center>GALPON</center></th>
                <th><center>OPCION</center></th>
                </thead>
				@foreach($edad as $eda)
				<tbody>
					<td>{{$eda->edad}}</td>
					<td>{{$eda->cantidad_actual}}</td>
					<td>
					{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $eda->id, $attributes = ['class'=>'btn btn-primary'])!!}
					</td>
				</tbody>
				@endforeach
		</table>

		{!!$edad->render()!!}