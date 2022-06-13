<?php 
session_start();
if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
}

require 'functions.php';

//ambil data di URL
$NO = $_GET["id"];

//query data mahasiswa berdasarkan ID
$mahasiswa = query("SELECT * FROM `daftar mahasiswa universitas pakuan`WHERE `NO` = $NO")[0];

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

	//cek apakah data berhasil diubah atau belum
	if( ubah($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diubah');
			document.location.href = 'index.php';
		</script>

		";
	} else {
		echo "
		<script>
			alert('Data Gagal Diubah');
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
	<title>Ubah Data</title>

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
	<h2>Ubah Data Mahasiswa</h2>
<br>
<img class="kiri" src="img/unpak2.jpg">

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="NO" value="<?= $mahasiswa["NO"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $mahasiswa["Gambar"]; ?>">
		<ul>
			<div>
				<label for = "Nama" >Nama : </label>
				<input type="text" name="Nama" NO="Nama"
				value="<?= $mahasiswa["Nama"]; ?>"> 
			</div>

			<div>
				<label for = "NPM" >NPM : </label>
				<input type="text" name="NPM" NO="NPM"autocomplete="off"
				value="<?= $mahasiswa["NPM"]; ?>">  
			</div>

			<div>
				<label for = "Kelas" >Kelas : </label>
				<input type="text" name="Kelas" NO="Kelas"autocomplete="off"
				value="<?= $mahasiswa["Kelas"]; ?>">  
			</div>

			<div>
				<label for = "Email" >Email : </label>
				<input type="text" name="Email" NO="Email"autocomplete="off"
				value="<?= $mahasiswa["Email"]; ?>"> 
			</div>
			<div>
				<label for = "Jurusan" >Jurusan : </label>
				<input type="text" name="Jurusan" NO="Jurusan"autocomplete="off"
				value="<?= $mahasiswa["Jurusan"]; ?>">  
			</div> 
			<div>
				<label for = "Gambar" >Gambar : </label> <br>
				<img src="img/<?= $mahasiswa['Gambar'];?>" width = "100"> <br>
				<input type="file" name="Gambar" NO="Gambar"> 
			</div>

			<div>
				<button type="submit" name ="submit">Ubah Data!</button>
			</div> 
		</ul>

	</form>

</body>
</center>
</html>