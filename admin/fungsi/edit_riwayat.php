<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
	require '../../db_con/koneksi.php';

	$nip = $_POST['nip'];
	$keterangan = $_POST['keterangan'];
	
	$sql = "UPDATE proses_usul_berkala SET  keterangan = '$keterangan' WHERE nip = '$nip'";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '1';
		header('location:../usul_berkala.php');
	}
	else
		$_SESSION['pesan'] = '2';
		header('location:../usul_berkala.php');
		
?>

