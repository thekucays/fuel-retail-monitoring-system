<html>
	<head>
		<title> Fuel Retail v0.1 Login Page</title>
		<link rel="stylesheet" href="css\loginpage.css"
	</head>
	<body>
		<div class="container">
		<div class="card card-container">
			<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
			
			<form class="form-signin" name="loginform" method="post" id="loginform" action="classes\controller\LoginController.php">
				<input type="text" id="nip" name="nip" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
			</form>
		</div>
		</div>
	</body>
</html>