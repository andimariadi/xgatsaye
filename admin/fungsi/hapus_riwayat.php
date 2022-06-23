<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
include "../../db_con/koneksi.php";

$id =$_GET['id'];
$kategori =$_GET['kategori'];

$hapus = mysqli_query($con, "DELETE FROM riwayat_usul_berkala WHERE id = '$id'");

	if($hapus){
	    $_SESSION['pesan'] = '1';
		header('location:../arsip.php');
	}else{
	    $_SESSION['pesan'] = '2';
		header('location:../arsip.php');
	}

?>