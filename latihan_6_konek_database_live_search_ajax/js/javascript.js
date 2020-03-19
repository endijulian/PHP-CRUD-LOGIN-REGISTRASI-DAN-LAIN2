// ambil elemen elemen yang dibutuhkan
var keyword = document.getElementById('keyword');
var tombolcari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

	// tombolcari.addEventListener('mouseover', function() {
	// 	alert('Berhasil');
	// });

	// TAMBAHKAN EVENT KETIKA KEYWORD DITULIS
	keyword.addEventListener('keyup', function() {
		
			// BUAT OBJECK AJAX
			var xhr = new XMLHttpRequest();

			// CEK KESIAPAN AJAX
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					container.innerHTML = xhr.responseText;
				}
			}

			// EKSEKUSI AJAX NYA
			xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
			xhr.send();

		});

