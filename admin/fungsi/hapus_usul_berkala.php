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

// Hapus Folder Berkas
	$dir = "../../berkas/$kategori/$nip";

	// Hapus File
	$filecount = 0;
	$files = glob($dir . "*");
	if ($files){
	 $filecount = count($files);
	};

	if ($filecount !== "0") {
		$files = glob("$dir/*.pdf");
		foreach ($files as $file) {
		    if (is_file($file))
		    unlink($file);
		};
	};

	// Hapus Folder
	rmdir("$dir");

$berkas = mysqli_query($con,"SELECT * FROM berkas WHERE nip = $nip");
$berkas = mysqli_num_rows($berkas);

if ($berkas != '0') {
	$hapus1 = mysqli_query($con, "DELETE FROM berkas WHERE nip = '$nip'");
}

$hapus = mysqli_query($con, "DELETE FROM proses_usul_berkala WHERE nip = '$nip'");

	if($hapus){
	    $_SESSION['pesan'] = '5';
		header('location:../usul_berkala.php');
	}else{
	    $_SESSION['pesan'] = '6';
		header('location:../usul_berkala.php');
	}

?>