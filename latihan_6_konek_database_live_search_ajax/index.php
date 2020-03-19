<?php  
		session_start();
	
	if ( !isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}

	require 'functions.php';

	$mahasiswa = query("SELECT * FROM mahasiswa"); //ASC dan DESC

	// tombol cari ditekan
	if (isset($_POST["cari"])) {
		$mahasiswa = cari($_POST["keyword"]);
	}
	
 ?>
	

<!DOCTYPE html>
<html>
<head>
	<title>halaman admin</title>
</head>
<body>
	<a href="logout.php"> Logout </a>
	<h1>Table Mahasiswa</h1>

		<a href="tambah_data.php">Tambah Data!</a>
		<br>
		<br>

		<form action="" method="POST">
			<input type="text" name="keyword" size="50" autofocus placeholder="Masukan keyword Pencarian!" autocomplete="off" id="keyword">
			<button type="submit" name="cari" id="tombol-cari">Cari!</button>
		</form>
		<br>
		<br>

	<div id="container">
		<table border="1" cellpadding="8" cellspacing="0">
			<tr>
				<th>No</th>
				<th>Aksi</th>
				<th>Gambar</th>
				<th>Nama</th>
				<th>Nim</th>
				<th>Fakultas</th>
				<th>Email</th>
			</tr>

		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row) :?>
			<tr>
				<td><?= $i; ?></td>
				<td>
					<a href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin data ingin di ubah?');">Ubah</a> |
					
					<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
				</td>
				<td><img src="img/<?= $row["gambar"]; ?>" width="50" height="50"></td>
				<td><?= $row["nama"]; ?></td>
				<td><?= $row["nim"]; ?></td>
				<td><?= $row["jurusan"]; ?></td>
				<td><?= $row ["email"]; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
		</table>
	</div>

	<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>