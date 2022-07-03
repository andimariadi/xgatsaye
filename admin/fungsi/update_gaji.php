<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';
    $id             = htmlentities(trim( $_POST['id'] ));
	$pangkat        = htmlentities(trim( $_POST['pangkat'] ));
	$masa_jabatan   = htmlentities(trim( $_POST['masa_jabatan'] ));
	$golongan       = htmlentities(trim( $_POST['golongan'] ));
	$gaji_pokok     = htmlentities(trim( $_POST['gaji_pokok'] ));
	
	$sql = "UPDATE `table_gajih` SET `pangkat`='{$pangkat}',`masa_jabatan`='{$masa_jabatan}',`golongan`='{$golongan}',`gaji_pokok`='{$gaji_pokok}' WHERE `id` = {$id};";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Data gaji Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_gaji.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal update data!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_gaji.php');
    }

?>

