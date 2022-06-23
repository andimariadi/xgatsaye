<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
	require '../../db_con/koneksi.php';

	$nip 			= $_POST['nip'];
	$keterangan 	= $_POST['keterangan'];
	$proses 				= htmlentities(trim( $_POST['proses'] ));
	$form 					= htmlentities(trim( $_POST['form'] )) == "on" ? "true" : "false";
	$sk_berkala_terakhir 	= htmlentities(trim( $_POST['sk_berkala_terakhir'] )) == "on" ? "true" : "false";
	$sk_pangkat_terakhir 	= htmlentities(trim( $_POST['sk_pangkat_terakhir'] )) == "on" ? "true" : "false";
	$sk_pemangku_jabatan 	= htmlentities(trim( $_POST['sk_pemangku_jabatan'] )) == "on" ? "true" : "false";

	
	$sql = "UPDATE proses_usul_berkala SET  keterangan = '$keterangan' WHERE nip = '$nip'";
	$result = mysqli_query($con, $sql);

	$sql = "UPDATE berkas_ajuan_usul_berkala SET form='$form',sk_berkala_terakhir='$sk_berkala_terakhir',sk_pangkat_terakhir='$sk_pangkat_terakhir',sk_pemangku_jabatan='$sk_pemangku_jabatan', keterangan = '$keterangan', `admin` = '$proses' WHERE nip = '$nip'";
	
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '3';
		header('location:../usul_berkala.php');
	}
	else
		$_SESSION['pesan'] = '4';
		header('location:../usul_berkala.php');
		
?>

