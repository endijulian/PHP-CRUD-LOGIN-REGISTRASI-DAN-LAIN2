<?php 

		session_start();
		require 'functions.php';

	// cek cookie
	if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
		$id = $_COOKIE['id'];
		$key = $_COOKIE['key'];

		// ambil username berdasarkan id
		$result = mysqli_query($conn, "SELECT username FROM user WHERE id=$id ");
		$row = mysqli_fetch_assoc($result);

		// cek cookie dan username
		if ( $key === hash('sha256', $row['username'])) {
			$_SESSION['login'] = true;
		}
	}

	
	//  cek session
	if (isset($_SESSION["login"])) {
		header("Location: index.php");

		exit;
	}

	

	// cek apakah tombol submit sudah ditekan atau belum
	if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

	// cek username
	if  (mysqli_num_rows($result) === 1 ) {
		
		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])){

			// set session
			$_SESSION["login"] = true;

			// cek remember me
			 if ( isset($_POST['remember'])) {
			 	
			 	// buat cookie nya
			 	setcookie('id', $row['id'], time()+60 );
			 	setcookie('key', hash('sha256', $row['username']), time() +60);

			 }

			header("Location: index.php");
			exit;
		}
	}

	$error = true;

	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>halaman login</title>
</head>
<body>
	<h2>halaman login</h2>

	<?php if(isset($error)) : ?>
		<p style="color:red; font-style: italic;">Username Atau Password Salah!!!</p>
	<?php endif; ?>

	<form action="" method="POST">
		<ul>
			<li>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				
				<input type="checkbox" name="remember" id="remember">
				<label for="remember"> Remember Me</label>
			</li>
			<li>
				<button type="submit" name="login">LOGIN</button>
			</li>
		</ul>
	</form>
</body>
</html>