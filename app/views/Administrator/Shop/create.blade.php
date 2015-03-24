@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            New Item
        </h3>
    </div>
</div>

<div class="row">
	{{ Form::open(array('url' => 'administrator/shop', 'method' => 'POST', 'class' => 'form')) }}
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="Enter Item Name Here..." required autofocus>
		</div>

		<div class="form-group">
			<input type="text" name="price" class="form-control" placeholder="Prices" required>
		</div>

		<div class="form-group">
			<textarea name="description" rows="10" class="form-control"></textarea>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">Options</div>

			<div class="panel-body">
        		<button type="submit" name="submit" class="btn btn-success pull-left" />Add Item</button>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
@stop