@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Product Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <a href="{{ URL::to('administrator/product/create') }}" class="btn btn-primary btn-sm">New Product</a>
            </div>
            <div class="box-tools">
                <div class="pull-right">
                    <input value="Search" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="box-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th class="col-md-2">Actions</th>
                    </tr>
                </thead>

                <tbody class="">
                    @forelse ($products as $product)
                    <tr>
                        <td><a href="{{ URL::to('administrator/product/' . $product->id . '/edit') }}"><img src="{{ asset('upload/product/test.jpg') }}" alt="..." class="img-thumbnail"></a></td>
                        <td><a href="{{ URL::to('administrator/product/' . $product->id . '/edit') }}">{{ $product->name }}</a></td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <div class="pull-left">
                                {{ Form::open(array('url' => 'administrator/product/' . $product->id, 'method' => 'POST', 'class' => 'form')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <input class="btn btn-danger btn-sm" name="delete" type="submit" value="Delete">
                                {{ Form::close() }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('administrator/product/' . $product->id) }}" class="btn btn-primary btn-sm">View</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Not Product Yet</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>        
    </div>    
</section>
@stop