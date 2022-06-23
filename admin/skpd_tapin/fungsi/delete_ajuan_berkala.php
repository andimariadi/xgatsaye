<?php 
session_start();
 
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}

	require '../../../db_con/koneksi.php';
	$nip = htmlentities(trim( $_POST['nip']));
	$usul_pangkat = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala WHERE nip = '$nip'");
	$data = mysqli_fetch_assoc($usul_pangkat);

	if (file_exists("../../..".$data['file_path'])) {
		unlink("../../..".$data['file_path']);
	}
	// SQL
	$sql = "DELETE FROM `ajuan_usul_berkala` WHERE `nip` = '" . $nip . "'";
	$result = mysqli_query($con, $sql);
?>