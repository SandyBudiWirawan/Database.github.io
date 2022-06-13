<?php
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ){
		$_SESSION['login'] = true;
	}
}

if(isset($_SESSION['login']) ){
	header("Location: index.php");
	exit;
}

	
	if( isset($_POST["login"])) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	//cek username
	if(mysqli_num_rows($result) === 1){
		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			//set session
			$_SESSION['login'] = true;

			//cek remember me
			if( isset($_POST['remember']) ){
				//buat cookie

				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60 );
			}

			header("Location: index.php");
			exit;
		}
	}
	$error = true;

}


?>
<!DOCTYPE html>
<html>
<center>
<h2>Universitas <br> Pakuan Bogor</h2>
<br>
<br>
<br>
<br>
<br>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style.css">

</head>
<style>
	label {
		display: block;
	}

</style>
<body>
		<p style="color: purple; width: 90px; font-size: 40px;  font-family: sans-serif;">Login</p>
	<?php if( isset($error)) : ?>
		<p style="color: red; font-style: italic; font-size: 15px; margin-left: 30px;">username / password salah</p>
		
	<?php endif; ?>
	<form action="" method="post">
	<div>
	<p>
	<label for="username">Username :</label>
	<input type="text" name="username" id="username"autocomplete="off">
	</p>
	<p>
	<label for="password">Password :</label>
	<input type="password" name="password" id="password">
	</p>
	<p>
	<input type="checkbox" name="remember" id="remember">
	<label for="remember">Remember username</label>
	</p>                                                                                     
	<p>
	<button type="submit" name="login">Login</button>
	</p>
	</div>
	<br>
	<br>
	<p style="color: black; font-size: 15px; margin-left: 5px; font-family: sans-serif;">Buat Akun Baru?</p>
	<h3><p style="color: royalblue; font-size: 15px; margin-left: 5px; font-family: sans-serif;"><a href="registrasi.php">Daftar Disini!</a></p></h3>
	<br>

	<h2> Created by Sandy Budi Wirawan </h2>

</table>

</body>
</center>
</html>