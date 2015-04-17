<div class="tab-pane" id="prepaid">
    <h5>Prepaid Card</h5>
    <hr>
    <div class="col-md-6 col-md-offset-1">
        {{ Form::open(array('url' => 'prepaid', 'method' => 'POST', 'class' => 'form')) }}


        <div class="form-group">
            @if ($errors->has('serial'))
            <input type="text" name="serial" class="form-control" placeholder="Serial Number" value="{{ Input::old('serial') }}" required autofocus><span class="text-danger">{{ $errors->first('serial') }}</span>
            @else
            <input type="text" name="serial" class="form-control" placeholder="Serial Number" value="{{ Input::old('serial') }}" required autofocus>
            @endif
        </div>


        <div class="form-group">
            @if ($errors->has('code'))
            <input type="text" name="code" class="form-control" placeholder="Prepaid Code" required><span class="text-danger">{{ $errors->first('code') }}</span>
            @else
            <input type="text" name="code" class="form-control" placeholder="Prepaid Code" required>
            @endif                
        </div>

        <input type="submit" class="col-md-12 btn btn-primary" value="Submit">

        {{ Form::close() }}  
    </div>
</div>