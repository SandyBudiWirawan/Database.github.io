<?php 
session_start();
if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}

require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

	//cek apakah data berhasil diubah atau belum
	if( tambah($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'index.php';
		</script>

		";
	} else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'index.php';
		</script>

		";
	}
}
?>
<!DOCTYPE html>
<html>
<center>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<style>
	label {
		display: block;
	}
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
	ul{
		margin: 20px;
		margin-left: -10px;
	}
</style>
<body>
	<h2>Tambah Data Mahasiswa</h2>

	<form action="" method="post" enctype="multipart/form-data">
		<br>
		<br>
		<img class="kiri" src="img/unpak2.jpg">
		<ul>
			<div>
				<label for = "Nama" >Nama : </label>
				<input type="text" name="Nama" NO="Nama"autocomplete="off"> 
			</div>

			<div>
				<label for = "NPM" >NPM : </label>
				<input type="text" name="NPM" NO="NPM"autocomplete="off"> 
			</div>

			<div>
				<label for = "Kelas" >Kelas : </label>
				<input type="text" name="Kelas" NO="Kelas"autocomplete="off"> 
			</div>

			<div>
				<label for = "Email" >Email : </label>
				<input type="text" name="Email" NO="Email"autocomplete="off">
			</div>
			<div>

				<label for = "Jurusan" >Jurusan : </label>
				<input type="text" name="Jurusan" NO="Jurusan"autocomplete="off"> 
			</div> 
			<div>
				<label for = "Gambar" >Gambar : </label>
				<input type="file" name="Gambar" NO="Gambar" required> 
			</div>

			<div>
				<button type="submit" name ="submit">Tambah Data!</button>
			</div> 
		</ul>

	</form>

</body>
</center>
</html>