<?php 
session_start();
 
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}

	require '../../../db_con/koneksi.php';
	$id = htmlentities(trim( $_POST['id']));
	$usul_pangkat = mysqli_query($con,"SELECT * FROM table_pangkat WHERE id = $id");
	$data = mysqli_fetch_assoc($usul_pangkat);

	if (file_exists("../../..".$data['file_path'])) {
		unlink("../../..".$data['file_path']);
	}

	// SQL
	$sql = "DELETE FROM `table_pangkat` WHERE `id` = " . $id;
	$result = mysqli_query($con, $sql);
?>