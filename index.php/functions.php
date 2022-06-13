<?php 
// koneksi ke data base
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;

	$Nama = htmlspecialchars($data["Nama"]);
	$NPM = htmlspecialchars($data["NPM"]);
	$Kelas = htmlspecialchars($data["Kelas"]);
	$Email = htmlspecialchars($data["Email"]);
	$Jurusan = htmlspecialchars($data["Jurusan"]);

	//upload gambar
	$Gambar = upload();
	if( !$Gambar ) {
		return false;
	}


	$query = "INSERT INTO `daftar mahasiswa universitas pakuan`
				VALUES
				('','$Gambar','$Nama', '$NPM', '$Kelas', '$Email', '$Jurusan')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload(){
	$namaFile = $_FILES['Gambar']['name'];
	$ukuranFile = $_FILES['Gambar']['size'];
	$error = $_FILES['Gambar']['error'];
	$tmpName = $_FILES['Gambar']['tmp_name'];

	//cek apakah tidak ada gambar yang di upload
	if( $error === 4){
		echo "<script>
		alert('Pilih Gambar Terlebih Dahulu!');
		</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
		alert('Yang Anda Upload Bukan Gambar!');
		</script>";
		return false;
	}
		//cek jika ukuran teralalu besar
	if($ukuranFile >1000000){
		echo "<script>
				alert('Ukuran Gambar Terlalu Besar');
			</script>";
			return false;
	}
 
 	// lolos pengecekan, gambar siap di upload
 	//generate nama gambar baru
 	$namaFileBaru = uniqid();
 	$namaFileBaru .= '.';
 	$namaFileBaru .= $ekstensiGambar;


 	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
 	return $namaFileBaru;


}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `daftar mahasiswa universitas pakuan` WHERE NO = $id");

	return mysqli_affected_rows($conn);
}
function ubah($data) {

	global $conn;

	$NO = $data["NO"];
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$Nama = htmlspecialchars($data["Nama"]);
	$NPM = htmlspecialchars($data["NPM"]);
	$Kelas = htmlspecialchars($data["Kelas"]);
	$Email = htmlspecialchars($data["Email"]);
	$Jurusan = htmlspecialchars($data["Jurusan"]);

	// cek apakah user memilih gambar baru atau tidak
	if($_FILES['Gambar']['error'] === 4){
		$Gambar = $gambarLama;

	} else {
		$Gambar = upload();
	}

	$query = "UPDATE `daftar mahasiswa universitas pakuan` SET
					Gambar = '$Gambar',
					Nama = '$Nama',
					NPM = '$NPM',
					Kelas = '$Kelas',
					Email = '$Email',
					Jurusan = '$Jurusan'
					WHERE NO = $NO
					";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if( mysqli_fetch_assoc($result)){
		echo "<script>
				alert('Username Sudah Terdaftar!');
			</script>";
			return false;
	}

	//cek konfirmasi password
	if( $password !== $password2 ){
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai');
			</script>";
			return false;
	}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);

}


function cari($keyword){
	$query = "SELECT * FROM `daftar mahasiswa universitas pakuan`
		WHERE
		Nama LIKE '%$keyword%' OR
		NPM LIKE '%$keyword%' OR
		Kelas LIKE '%$keyword%' OR
		Email LIKE '%$keyword%' OR
		Jurusan LIKE '%$keyword%'
		 ";
		 return query($query);
}




?>