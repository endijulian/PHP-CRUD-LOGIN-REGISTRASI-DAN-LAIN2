<?php 
	
	require 'functions.php';

	if (isset($_POST["registrasi"])) {
		if (registrasi($_POST) > 0 ) {
			echo "<script>
						alert('User berhasil ditambhakan');
					</script>
				";
		} else{
			echo mysqli_error($conn);
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>halaman registrasi</title>
	<style type="text/css">
		label{
			display: block;
		}
	</style>
</head>
<body>
	<h1>HALAMAN REGISTRASI</h1>
	<form action="" method="POST">
		<ul>
			<li>
				<label for="username"> Username:</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password"> Password:</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label for="password2">Konfirmasi password:</label>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<button type="submit" name="registrasi">Daftar</button>
			</li>
		</ul>
	</form>
</body>
</html>