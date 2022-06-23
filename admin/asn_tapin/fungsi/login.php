<!-- <?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../koneksi/koneksi.php';

$nip = $_POST['nip'];
// $token = $_POST['token'];

$login = mysqli_query($con,"SELECT * FROM proses_naik_pangkat WHERE nip='$nip' AND token='$token'");
$cek = mysqli_num_rows($login);

if($cek > 0){

	$_SESSION['nip'] = $nip;
	$_SESSION['type'] = "login_token";
	header("location:../upload_berkas.php#upload_berkas");

}else{
	echo "<script>alert('Login gagal, cek kembali NIP dan TOKEN anda !');document.location='../index.php'</script>";
}

?> -->