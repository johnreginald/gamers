@extends('User.layout')

@section('content')

<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li><a href="{{ URL::to('reseller') }}">Reseller Panel</a></li>
        <li class="active">New Product</li>
    </ol>
    
    @include('User.message')
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
					{{ Form::open(array('url' => 'reseller/save', 'method' => 'POST', 'class' => 'form', 'files' => true)) }}

					<div class="col-md-10">
						<div class="form-group">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 250px; height: 200px;">
									<img data-src="holder.js/100%x100%" alt="...">
								</div>
								
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"></div>
								
								<div>
									<span class="btn btn-default btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="image">
									</span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>

							@if ($errors->has('image'))
							<p class="text-danger">{{ $errors->first('image') }}</p>
							@endif				
						</div>

						@if ($errors->has('name'))
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Item Name..." value="{{ Input::old('name') }}" required autofocus>
							<span class="text-danger">{{ $errors->first('name') }}</span>
						</div>
						@else
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Item Name..." value="{{ Input::old('name') }}" required autofocus>
						</div>
						@endif

						@if ($errors->has('price'))
						<div class="form-group"><input type="text" name="price" class="form-control" placeholder="Price" value="{{ Input::old('price') }}">
							<span class="text-danger">{{ $errors->first('price') }}</span>
						</div>
						@else
						<div class="form-group">
							<input type="number" name="price" class="form-control" placeholder="Price" value="{{ Input::old('price') }}">
						</div>
						@endif						

						@if ($errors->has('description'))
						<div class="form-group">
							<span class="text-danger">{{ $errors->first('description') }}</span>
							<textarea id="ide" name="description" class="form-control">{{ Input::old('description') }}</textarea>
						</div>
						@else
						<div class="form-group">
							<textarea id="ide" name="description" class="form-control">{{ Input::old('description') }}</textarea>
						</div>
						@endif

						<button type="submit" name="submit" class="btn btn-success pull-left" />Add Product</button>			
					</div>			
					{{ Form::close() }}
				</div>
			</div>
		</div>
    </div>
</div>
@include('User.reseller.script')
@stop