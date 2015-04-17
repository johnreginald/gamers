@if ( Session::get('message') )
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-{{ Session::get('status') }} alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('message') }}
		</div>
	</div>
</div>
@endif