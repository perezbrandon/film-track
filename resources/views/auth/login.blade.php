<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Flick Track</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<!-- Custom Stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
  <link href="/img/favicon.ico" rel="icon" type="image/x-icon" />
  <!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="js/login.js"></script>
</head>

<body>

	<!-- TODO: DISPLAY ERRORS WHEN LOGGING IN OR REGISTERING -->

  <div class="top">
    <h1 id="title"><span id="logo">Film Track </span></h1>
  </div>
  <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">

                <!-- LOGIN! FORM -->
								<form id="login-form" action="{{ url('/login') }}" method="post" role="form" style="display: block;">
									{{ csrf_field() }}
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
                <!-- REGISTRATION FORM -->
								<form id="register-form" role="form" method="POST" action="{{ url('/register') }}" style="display: none;">
									{{ csrf_field() }}
									<div class="form-group">
										<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Username" value="{{ old('name') }}">
										@if ($errors->has('name'))
												<span class="help-block">
														<strong>{{ $errors->first('name') }}</strong>
												</span>
										@endif
									</div>
									<div class="form-group">
										<input id="email" type="email" class="form-control" placeholder="Email" tabindex="1" name="email" value="{{ old('email') }}" required>
										@if ($errors->has('email'))
												<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
												</span>
										@endif
									</div>
									<div class="form-group">
										<input id="password" type="password" class="form-control" tabindex="2" name="password" placeholder="password" required>
										@if ($errors->has('password'))
												<span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
												</span>
										@endif
									</div>
									<div class="form-group">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
