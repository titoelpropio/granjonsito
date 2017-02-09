@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert" id="oculta">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4>{{Session::get('message')}}</h4>
</div>
@endif