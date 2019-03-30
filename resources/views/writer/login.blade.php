<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/assets/css/ivy.css">
	<link rel="stylesheet" href="/assets/css/all.css">
	<link rel="stylesheet" href="/assets/css/main.css">
	<title>Writer Dashboard - Login</title>
</head>
<body class="dashboard_login">
	
	<div class="container">

		<div class="row config login">

				<div class="row config_title">
					<span>Dashboard Login</span>
					<hr>
				</div>

				<div class="row content socials">
					
					<form id="login_form" action="{{ route('auth') }}" method="POST">
                        
                        @csrf

						<div class="row u-full-width">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" placeholder="johndoe">
						</div>
						<div class="row u-full-width">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
						</div>

						<button type="submit" style="display: none">Login</button>

					</form>

				</div>

				<div class="row config_save">
					<a href="#" id="login_btn">
						Login

						<img src="/assets/img/green_arrow.svg" alt="arrow">
					</a>
				</div>

			</div>
		
	</div>
    
    @include('partials.alert')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
