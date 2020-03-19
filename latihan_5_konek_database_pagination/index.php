<?php  
		session_start();
	
	if ( !isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}

	require 'functions.php';

	// pagination
	// konfigurasi
	$jumlahdataperhalaman = 1;
	$jumlahdata = count(query("SELECT * FROM mahasiswa"));
	$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
	$halamanaktif = (isset($_GET['halaman'])) ? $_GET["halaman"] : 1; 
	$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
	


	$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata, $jumlahdataperhalaman"); //ASC dan DESC

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
			<input type="text" name="keyword" size="50" autofocus placeholder="Masukan keyword Pencarian!" autocomplete="off">
			<button type="submit" name="cari">Cari!</button>
		</form>
		<br>

		<!-- NAVIGASI -->
		<?php if($halamanaktif > 1 ) : ?>
			<a href="?halaman=<?= $halamanaktif - 1 ?>">&laquo;</a>
		<?php endif; ?>

		<?php for($i =1; $i <= $jumlahhalaman; $i++) : ?>

			<?php if( $i == $halamanaktif) : ?>
				<a href="?halaman=<?= $i; ?>" style="font-weight: bolt; color: red;"> <?= $i; ?> </a>
			<?php else : ?>
				<a href="?halaman=<?= $i; ?>"> <?= $i; ?> </a>
			<?php endif; ?>

		<?php endfor; ?>

		<?php if($halamanaktif < $jumlahhalaman ) : ?>
			<a href="?halaman=<?= $halamanaktif + 1 ?>">&raquo;</a>
		<?php endif; ?>

		<br>
		<br>

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
</body>
</html>