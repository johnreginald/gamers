@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Categories</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header"><h4>Edit Category</h4></div>
                {{ Form::open(array('url' => 'administrator/categories/' . $category->id, 'method' => 'POST', 'class' => 'form')) }}
                {{ Form::hidden('_method', 'PUT') }}
				<div class="box-body">
					@if ($errors->has('name'))
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ $category->name }}" required>
						<span class="text-danger">{{ $errors->first('name') }}</span>
					</div>
					@else
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ $category->name }}" required>
					</div>
					@endif

					<div class="form-group">
						<textarea class="form-control" rows="5" name="description">{{ $category->description }}</textarea>
					</div>
				</div>

				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Update">
				</div>
				{{ Form::close() }}
			</div>
		</div> <!-- Create END -->

		<div class="col-md-6">
		    <div class="box">
		        <div class="box-body">
	                <table class="table table-hover table-bordered">
	                    <thead>
	                        <tr>
	                            <th>Name</th>
	                            <th>Slug</th>	                        
	                            <th>Date</th>
	                            <th class="col-md-2">Actions</th>
	                        </tr>
	                    </thead>

	                    <tbody>
	                        @forelse ($categories as $category)
	                        <tr>
	                            <td>
	                                <a href="{{ URL::to('administrator/categories/' . $category->id . '/edit') }}">{{ $category->name }}</a>
	                            </td>
	                            <td>{{ $category->slug }}</td>
	                            <td>{{ $category->created_at }}</td>
	                            <td class="col-md-3">
	                            	Edit | Delete
	                            </td>
	                        </tr>
	                        @empty
	                        <tr>
	                            <td>There's no Posts to show.</td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                        </tr>
	                        @endforelse
	                    </tbody>
	                </table>
		        </div>
		    </div>
		</div>	<!-- List END -->
	</div>
</section>
@stop