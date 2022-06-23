<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../db_con/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Mencegah SQL Injection
$username = str_replace("'","/'",$username);
$password = str_replace("'","/'",$password);

// Query Admin
$login = mysqli_query($con,"SELECT * FROM verifikator_berkala WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// Login Admin
	if($data['level']=="admin"){

		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:../admin/index.php");

	// Login SKPD
	}else if($data['level']=="skpd"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "skpd";
		$_SESSION['skpd'] = $data['skpd'];
		header("location:../admin/skpd_tapin/index.php");

	};

} else {
  // Query Pegawai
  $login = mysqli_query($con, "SELECT * FROM proses_usul_berkala WHERE nip='$username' AND token='$password'");
  $cek = mysqli_num_rows($login);

  if ($cek > 0) {

    $_SESSION['nip'] = $username;
    $_SESSION['type'] = "login_token";
    header("location:../admin/asn_tapin/index.php");
  } else {
    echo "<script>alert('Login gagal, cek kembali Username / NIP dan Password / TOKEN anda !');document.location='../index.php'</script>";
  };
}
?>