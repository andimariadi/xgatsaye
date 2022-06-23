<?php 
session_start();
 
// if($_SESSION['type'] !="login_token"){
//     header("location:../index.php");
//     }
?>
<?php
	require '../../../db_con/koneksi.php';

	$nip = $_POST['nip'];
	$pemberkasan_status = "Berkas Masuk";

	$sql = "UPDATE proses_usul_berkala SET pemberkasan_status = '$pemberkasan_status' WHERE nip = '$nip'";
	$result = mysqli_query($con, $sql);

	if($result){
		$_SESSION['pesan'] = '6';
		header("location:../index.php");
	}
	else
		$_SESSION['pesan'] = '7';
		header("location:../index.php");
		
?>