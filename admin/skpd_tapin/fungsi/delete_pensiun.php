<?php 
session_start();
 
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}

	require '../../../db_con/koneksi.php';
	$id = htmlentities(trim( $_POST['id']));
	$usul_pangkat = mysqli_query($con,"SELECT * FROM table_pensiun WHERE id = $id");
	$data = mysqli_fetch_assoc($usul_pangkat);

	if (file_exists("../../..".$data['file_path_spp'])) {
		unlink("../../..".$data['file_path_spp']);
	}
	if (file_exists("../../..".$data['file_path_sk'])) {
		unlink("../../..".$data['file_path_sk']);
	}
	if (file_exists("../../..".$data['file_path_ktp'])) {
		unlink("../../..".$data['file_path_ktp']);
	}
	if (file_exists("../../..".$data['file_path_foto'])) {
		unlink("../../..".$data['file_path_foto']);
	}
	// SQL
	$sql = "DELETE FROM `table_pensiun` WHERE `id` = " . $id;
		
	$result = mysqli_query($con, $sql);
?>