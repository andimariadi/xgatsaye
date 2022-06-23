<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
include "../../db_con/koneksi.php";

$nip =$_GET['nip'];
$kategori =$_GET['kategori'];


$hapus = mysqli_query($con, "DELETE FROM ajuan_usul_berkala WHERE nip = '$nip'");

	if($hapus){
	    $_SESSION['pesan'] = '1';
		header('location:../ajuan_berkala.php');
	}else{
	    $_SESSION['pesan'] = '2';
		header('location:../ajuan_berkala.php');
	}

?>