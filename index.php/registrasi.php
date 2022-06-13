<?php
	require 'functions.php';
	
	if( isset($_POST["register"])) {
		if( registrasi($_POST) > 0){
			echo "<script>
			alert('User Baru Berhasil Ditambahkan');
			document.location.href = 'login.php';
			</script>";
		} else {
			echo mysqli_error($conn);
		}
	}
?>

<!DOCTYPE html>
<html>
<center>
<h2>Universitas <br> Pakuan Bogor</h2>
<br>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" href="style.css">
</head>
<style>
	label {
		display: block;
	}
</style>
<body>
<br>
<br>
<br>
<br>
<br>


		<p style="color: purple; width: 120px; font-size: 40px; margin-right: 50px; font-family: sans-serif;">Registrasi</p>
		
	<form action="" method="post">

		<ul>
			<p>
				<label for="username">Username :</label>
				<input type="text" name="username" id="username" autocomplete="off">
			</p>
			<p>
				<label for="password">Password :</label>
				<input type="password" name="password" id="password">
			</p>
			<p>
				<label for="password2">Konfirmasi Password :</label>
				<input type="password" name="password2" id="password2">
			</p>
			<p>
				<button type="submit" name="register">Register!</button>
			</p>
		</ul>
<br>
<br>
<br>
<br>
<br>
<br>

	<h2> Created by Sandy Budi Wirawan </h2>


</table>

</body>
</center>
</html>