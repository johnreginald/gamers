@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Message Box</h1>
</section>

<section class="content">
    @include('Administrator.message')	
    <div class="box">
        <div class="box-header"><h5>Send Message to Everyone</h5></div>
        <div class="box-body">
            {{ Form::open(array('url' => 'administrator/message', 'method' => 'POST', 'class' => 'form')) }}
            <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Subject" required autofocus>
            </div>
    
            <div class="form-group">
                <textarea name="message" rows="10" class="form-control"></textarea>
            </div>
    
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success" />Send</button>
            </div>
            {{ Form::close() }}
	    </div>
    </div> 
</section>
@stop