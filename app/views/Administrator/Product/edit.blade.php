@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Edit Product</h1>
</section>

<section class="content">
    @include('Administrator.message')
    <div class="box">
        <div class="box-body">
            <div class="row">
                {{ Form::open(array('url' => 'administrator/product/' . $product->id, 'method' => 'POST', 'class' => 'form', 'files' => true)) }}
                {{ Form::hidden('_method', 'PUT') }}
                <div class="col-md-8">
                    @if ($errors->has('name'))
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Item Name..." value="{{ Input::old('name') }}" required autofocus>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    @else
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Item Name..." value="{{ $product->name }}" required autofocus>
                    </div>
                    @endif

                    @if ($errors->has('price'))
                    <div class="form-group"><input type="text" name="price" class="form-control" placeholder="Price" value="{{ Input::old('price') }}">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                    @else
                    <div class="form-group">
                        <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}">
                    </div>
                    @endif                      

                    @if ($errors->has('description'))
                    <div class="form-group">
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        <textarea id="ide" name="description">{{ Input::old('description') }}</textarea>
                    </div>
                    @else
                    <div class="form-group">
                        <textarea id="ide" name="description">{{ $product->description }}</textarea>
                    </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Product Image</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 200px;">
                                    <img src="{{ URL::to('uploads/products') }}/{{ $product->image }}" alt="...">
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
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-control btn btn-success" value="Update Product">
                    </div>
                </div>              
                {{ Form::close() }}
            </div>
        </div>
    </div>  
</section>

@include('Administrator.script')
@stop