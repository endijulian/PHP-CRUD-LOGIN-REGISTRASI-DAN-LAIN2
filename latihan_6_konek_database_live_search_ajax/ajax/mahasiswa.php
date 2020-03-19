<?php 

	require '../functions.php';
	$keyword = $_GET["keyword"];

	$query = "SELECT * FROM mahasiswa
				WHERE
					nama LIKE '%$keyword%' OR
					nim LIKE '%$keyword%' OR
					jurusan LIKE '%$keyword%' OR
					email LIKE '%$keyword%'
					";

	$mahasiswa = query($query);



 ?>

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