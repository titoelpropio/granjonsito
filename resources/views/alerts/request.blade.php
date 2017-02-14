
@if(count($errors) > 0 ) 
<div class="alert alert-danger alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4>INTRODUSCA LOS DATOS REQUERIDOS</h4>
	<ol>
		@foreach($errors->all() as $error)
		<li>
			<span style="text-transform:uppercase">{!!$error!!}</span>
		</li>
		@endforeach
	</ol>
</div>
@endif