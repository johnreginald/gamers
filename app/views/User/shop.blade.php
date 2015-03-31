@extends('User.layout')

@section('content')
<div class="container wrapper">

<ol class="breadcrumb">
  <li><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="active">Shop</li>
</ol>

    <div class="row">

        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        Item 1
                    </p>
                    <p>
                        {{ Form::open(array('url' => 'shop-add', 'method' => 'POST', 'class' => 'form')) }}
                            <input type="submit" value="Add to Cart" class="btn btn-primary">
                        {{ Form::close() }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        item 2
                    </p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        Item 3
                    </p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        Item 4
                    </p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>

    </div>
</div>	
@stop