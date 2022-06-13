<?php 
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM `daftar mahasiswa universitas pakuan`
		WHERE
		Nama LIKE '%$keyword%' OR
		NPM LIKE '%$keyword%' OR
		Kelas LIKE '%$keyword%' OR
		Email LIKE '%$keyword%' OR
		Jurusan LIKE '%$keyword%'
		 ";

$mahasiswa = query($query);

?>
<table border="5" cellpadding="28" cellspacing="5">
		<tr>
		<button>
		<a href="tambah.php">Tambah Data Mahasiswa</a>
		</button>
		<br><br>
		<form action="" method="post">
			<input type="text" name="keyword" size="30" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off" id="keyword">
			<button type="submit" name="cari" id="tombol-cari">Cari!</button>
		</form>
		<br>
		<br>
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>Nama</th>
			<th>NPM</th>
			<th>Kelas</th>
			<th>Email</th>
			<th>Jurusan</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach( $mahasiswa as $row) : ?>
		<tr>
			<td> <?= $i ?></td>
			<td>
			<button>
			<a href="ubah.php?id=<?php echo $row["NO"];?>">Ubah</a> |
			<a href="hapus.php?id=<?php echo $row["NO"]; ?>" onclick = "return confirm('Apakah Yakin Dihapus?'); " >Hapus</a>
			</button>
			</td>
			<td><img src="img/<?php echo $row["Gambar"]; ?> "width="80"></td>
			<td><?= $row["Nama"]; ?></td>
			<td><?= $row["NPM"]; ?></td>
			<td><?= $row["Kelas"]; ?></td>
			<td><?= $row["Email"]; ?></td>
			<td><?= $row["Jurusan"]; ?></td>
		</tr>
		<?php $i++ ?>
		<?php endforeach; ?>

</table>