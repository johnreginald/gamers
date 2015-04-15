@extends('User.layout')

@section('content')
<div class="container wrapper">

<ol class="breadcrumb">
  <li><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="active">Shop</li>
</ol>
    <div class="well">
        <h5>Browse Our Shop</h5>
        {{ Form::open(array('url' => 'search', 'method' => 'POST', 'class' => 'form form-inline')) }}
            <div class="form-group">
                <input class="form-control" type="text" name="item-name" placeholder="Search Your Item">
            </div>

            <div class="form-group">
                <select class="form-control">
                    <option>Game Item</option>
                    <option>Game Key</option>
                    <option>RIG</option>
                    <option>Dota 2</option>
                </select>
            </div>

            <button class="btn btn-primary">Search</button>
        {{ Form::close() }}
    </div>

    <div class="row">
        @foreach($shop as $s)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h3>{{ $s->name }}</h3>
                    <p>
                        {{ $s->description }}
                    </p>
                    <p>
                        {{ Form::open(array('url' => 'shop-add/', 'method' => 'POST', 'class' => 'form')) }}
                            <input type="hidden" name="id" value="{{ $s->id * 51235 }}">
                            <input type="submit" value="Add to Cart" class="btn btn-primary">
                        {{ Form::close() }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>	
@stop