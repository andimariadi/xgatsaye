<?php 
session_start();
 
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}

	require '../../../db_con/koneksi.php';
	$id = htmlentities(trim( $_POST['id']));
	$usul_pangkat = mysqli_query($con,"SELECT * FROM table_pangkat WHERE id = $id");
	$data = mysqli_fetch_assoc($usul_pangkat);

	if (file_exists("../../..".$data['file_path_sk_kenaikan_pangkat_terakhir'])) {
		unlink("../../..".$data['file_path_sk_kenaikan_pangkat_terakhir']);
	}
	if (file_exists("../../..".$data['file_path_fc_sk_cpns_pns'])) {
		unlink("../../..".$data['file_path_fc_sk_cpns_pns']);
	}
	if (file_exists("../../..".$data['file_path_fc_skp'])) {
		unlink("../../..".$data['file_path_fc_skp']);
	}
	if (file_exists("../../..".$data['file_path_fc_kp'])) {
		unlink("../../..".$data['file_path_fc_kp']);
	}

	// SQL
	$sql = "DELETE FROM `table_pangkat` WHERE `id` = " . $id;
	$result = mysqli_query($con, $sql);
?>