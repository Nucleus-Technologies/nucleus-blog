<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/assets/css/ivy.css">
	<link rel="stylesheet" href="/assets/css/all.css">
	<link rel="stylesheet" href="/assets/css/main.css">
	<title>Writer Dashboard - Register</title>
</head>
<body class="dashboard_login">
	
	<div class="container">

		<div class="row config login">

				<div class="row config_title">
					<span>Writer Register</span>
					<hr>
				</div>

				<div class="row content socials">
					
					<form action="{{ route('writers.store') }}" method="POST">
                        
                        @csrf

						<div class="row u-full-width">
							<div class="six columns">
								<label for="firstname">First name</label>
								<input type="text" name="first_name" id="firstname" placeholder="John">
							</div>
							<div class="six columns">
								<label for="lastname">Last name</label>
								<input type="text" name="last_name" id="lastname" placeholder="Doe">
							</div>
						</div>
						<div class="row u-full-width">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" placeholder="john@doe.com">
						</div>
						<div class="row u-full-width">
							<label for="phone">Phone number</label>
							<input type="tel" name="phone" id="phone" placeholder="+000123456789">
						</div>
						<div class="row u-full-width">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" placeholder="johndoe123">
						</div>
						<div class="row u-full-width">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" placeholder="8 minimum">
						</div>

						<button type="submit" style="display: none">Register</button>

					</form>

				</div>

				<div class="row config_save">
					<a href="#" class="save_btn">
						Register

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
