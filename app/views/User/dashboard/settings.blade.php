<div class="tab-pane" id="settings">
    <h5>Change Password</h5>
    <hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            {{ Form::open(array('url' => 'password', 'method' => 'POST', 'class' => 'form')) }}

            @if ($errors->has('oldpassword'))
            <div class="form-group"><input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required><span class="text-danger">{{ $errors->first('oldpassword') }}</span></div>
            @else
            <div class="form-group"><input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required></div>
            @endif

            @if ($errors->has('newpassword'))
            <div class="form-group"><input type="password" name="newpassword" class="form-control" placeholder="New Password" required><span class="text-danger">{{ $errors->first('newpassword') }}</span></div>
            @else
            <div class="form-group"><input type="password" name="newpassword" class="form-control" placeholder="New Password" required></div>
            @endif    

            @if ($errors->has('newpassword_confirmation'))
            <div class="form-group"><input type="password" name="newpassword_confirmation" class="form-control" placeholder="Verify New Password" required><span class="text-danger">{{ $errors->first('newpassword_confirmation') }}</span></div>
            @else
            <div class="form-group"><input type="password" name="newpassword_confirmation" class="form-control" placeholder="Verify New Password" required></div>
            @endif 

            <input type="submit" class="col-md-12 btn btn-primary" value="Change Password">

            {{ Form::close() }}
        </div>
    </div>
    <br>
    <h5>Change Email</h5>
    <hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            {{ Form::open(array('url' => 'email', 'method' => 'POST', 'class' => 'form')) }}

            @if ($errors->has('newemail'))
            <div class="form-group"><input type="email" name="newemail" class="form-control" placeholder="New Email Address" value="{{ Input::old('newemail') }}" required><span class="text-danger">{{ $errors->first('newemail') }}</span></div>
            @else
            <div class="form-group"><input type="email" name="newemail" class="form-control" placeholder="New Email Address" value="{{ Input::old('newemail') }}" required></div>
            @endif

            <input type="submit" class="col-md-12 btn btn-primary" value="Change Email Address">

            {{ Form::close() }} 
        </div>
    </div>
    <br>
    @if(Reseller::where('user_id', '=', Sentry::getUser()->id)->count() == 0 && Sentry::getUser()->type == 0)
    <hr>
    <h5>Reseller Application</h5>
    <p>Are you a Reseller Company? Send us an Application and wait for approval.</p>
    {{ Form::open(array('url' => 'reseller/application', 'method' => 'POST', 'class' => 'form')) }}
    <input type="submit" class="btn btn-primary" value="Send Application">
    {{ Form::close() }}     
    @endif
</div>