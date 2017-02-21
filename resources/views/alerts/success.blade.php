@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert" id="oculta">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <font size="4">{{Session::get('message')}}</font> 
  <div class="pull-right"><img src="{{asset('images/pollito2.GIF')}}" width="50px" height="50px"></div>
</div>
@endif