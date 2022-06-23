<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
	require '../../db_con/koneksi.php';

	date_default_timezone_set("Asia/Singapore");
	$tanggal = date("Y-m-d");

	$nip = $_POST['nip'];
	$kategori = $_POST['kategori'];
	$masa_jabatan = $_POST['masa_jabatan'];


	// Cek Usul Berkala
	$usul_berkala = mysqli_query($con,"SELECT nip FROM proses_usul_berkala WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_berkala);

	if ($usul > '0') {
		$_SESSION['pesan'] = '9';
		header('location:../data_pegawai.php');
	}
	else {

	// Buat Folder Berkas
	mkdir("../berkas/$kategori/$nip");

	// SQL
	$sql = "INSERT INTO `$db_name`.`proses_usul_berkala` (`tanggal`, `nip`, `kategori`, `masa_jabatan`) VALUES ('$tanggal', '$nip', '$kategori', '$masa_jabatan')";
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '7';
		header('location:../data_pegawai.php');
	}
	else
		$_SESSION['pesan'] = '8';
		header('location:../data_pegawai.php');
	};	
?>