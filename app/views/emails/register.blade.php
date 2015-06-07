<p>Hello {{ $username }}</p>
<p>Thanks for signing up to "For Gamers, By Gamers" Website.</p>
<p>Please Activate Your Account Before login.</p>
<p>Your Account Information</p>

	<p style="padding-left: 10px;">Username : {{ $username }}</p>
	<p style="padding-left: 10px;">Password : {{ $password }}</p>

<p>To activate your account, visit the following address:</p>
<a href="{{ URL::to('activate') }}/{{ $activationcode }}/{{ $id }}">Click Here</a>