<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
include "../../db_con/koneksi.php";

$nip =$_GET['nip'];

$perhitungan_proses = mysqli_query($con,"SELECT * FROM proses_usul_berkala WHERE nip = $nip");
$proses = mysqli_num_rows($perhitungan_proses);

$perhitungan_riwayat = mysqli_query($con,"SELECT * FROM riwayat_usul_berkala WHERE nip = $nip");
$riwayat = mysqli_num_rows($perhitungan_riwayat);

$perhitungan_berkas = mysqli_query($con,"SELECT * FROM berkas WHERE nip = $nip");
$berkas = mysqli_num_rows($perhitungan_berkas);

	if ($proses !== '0') {
		$hapus1 = mysqli_query($con, "DELETE FROM riwayat_usul_berkala WHERE nip='$nip'");
	};

	if ($riwayat !== '0') {
		$hapus2 = mysqli_query($con, "DELETE FROM berkas WHERE nip='$nip'");
	};

	if ($berkas !== '0') {
		$hapus3 = mysqli_query($con, "DELETE FROM proses_usul_berkala WHERE nip='$nip'");
	};

$hapus = mysqli_query($con, "DELETE FROM data_pegawai WHERE nip='$nip'");
if($hapus){
    $_SESSION['pesan'] = '5';
	header('location:../data_pegawai.php');
}else{
    $_SESSION['pesan'] = '6';
	header('location:../data_pegawai.php');
}

?>