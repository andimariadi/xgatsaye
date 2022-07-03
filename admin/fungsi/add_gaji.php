<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';

	$pangkat        = htmlentities(trim( $_POST['pangkat'] ));
	$masa_jabatan   = htmlentities(trim( $_POST['masa_jabatan'] ));
	$golongan       = htmlentities(trim( $_POST['golongan'] ));
	$gaji_pokok     = htmlentities(trim( $_POST['gaji_pokok'] ));
	
	$sql = "INSERT INTO `table_gajih`(`id`, `pangkat`, `masa_jabatan`, `golongan`, `gaji_pokok`) VALUES (NULL,'{$pangkat}','{$masa_jabatan}','{$golongan}','{$gaji_pokok}');";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Data gaji Berhasil ditambahkan!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_gaji.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Data gaji berhasil diupdate!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_gaji.php');
    }

?>

