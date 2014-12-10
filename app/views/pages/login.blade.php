@extends('layouts.nosidebar')

@section('content')	
	<!-- check for login error flash var -->
    @if(Session::has('flash_error'))
        <div class="flash_notice" id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif

	<div class="contentwrapper" style="color: white; padding: 0px 20px; margin: 0px auto;">
	<h1>Welcome</h1>
	<p>
		The Computer Aided Engineering Web (CAE Web) provides information about the College of Engineering and Applied Sciences (CEAS) and its resources.
		This site can be accessed by all members of the University community, with additional services for the Engineering family.
	</p></br>
	<p>
	For help with CAE Web, IT, A/V or building issue(s), please contact: 
		</p><p>
			CAE center staff<br> 
			Phone: (444) 444-4444<br>
			E-mail : <a href="mailto:cae@example.com?subject=CAEWeb">cae@example.com</a>
		</p></br> 
		<p>
			Joe Specialist<br/>
			IT & Classroom Technology Specialist<br/>
			Phone: (555) 555-5555<br/>
			Email: <a href="mailto:joe.specialist@example.com?subject=CAEWeb">joe.specialist@example.com</a>
		</p>
	</p>
@endsection

@section('logininfo')
    {{ Form::open(array('route' => 'login')) }}
    <!-- username field -->
    {{ Form::text('username', Input::old('username')) }}
    <!-- password field -->
    {{ Form::password('password') }}
    <!-- submit button -->
    
    {{ Form::submit('Login') }}
    {{ Form::close() }}
@endsection