<?php 
session_start();
if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM `daftar mahasiswa universitas pakuan`");

//cek tombol cari
if(isset($_POST['cari']) ){
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>

	<title>Halaman Sandy</title>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/script.js"></script>
</head>
<style>
	.kiri{
		margin-left:auto;margin-right:auto;display:block;width:200px;clear:both
	}
	h2{
		position: relative;
		margin: -10px;
		width: 1326px;
		color:white;  
		background-color:purple;  
		padding:20px;
		font-family: sans-serif;
	}
</style>
<body>
	<center><h2>Daftar Mahasiswa Universitas Pakuan</h2></center>
		<br>
		<button><a href="logout.php">Logout</a></button>
		<br>
		<img class="kiri" src="img/unpak2.jpg">
		

	<table border="5" cellpadding="25" cellspacing="5">
		<tr>
		<button>
		<a href="tambah.php">Tambah Data Mahasiswa</a>
		</button>
		<br>
		<br>
		<form action="" method="post">
			<input type="text" name="keyword" size="30" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off" id="keyword">
			<button type="submit" name="cari" id="tombol-cari">Cari!</button>
		</form>
		<br>
		<br>
		<tr>
			<th>No.</th>
			<th>Update</th>
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
			<td><img src="img/<?php echo $row["Gambar"]; ?> "width="90"></td>
			<td><?= $row["Nama"]; ?></td>
			<td><?= $row["NPM"]; ?></td>
			<td><?= $row["Kelas"]; ?></td>
			<td><?= $row["Email"]; ?></td>
			<td><?= $row["Jurusan"]; ?></td>
		</tr>
		<?php $i++ ?>
		<?php endforeach; ?>

</table>
</div>



</body>
</html>