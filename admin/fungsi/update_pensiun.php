<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';

	$id = htmlentities(trim( $_POST['id'] ));
	$proses = htmlentities(trim( $_POST['proses'] ));
	$spp = htmlentities(trim( $_POST['spp'] )) == "on" ? "true" : "false";
	$fc_sk_cpns_pns = htmlentities(trim( $_POST['fc_sk_cpns_pns'] )) == "on" ? "true" : "false";
	$fc_ktp = htmlentities(trim( $_POST['fc_ktp'] )) == "on" ? "true" : "false";
	$foto = htmlentities(trim( $_POST['foto'] )) == "on" ? "true" : "false";
	
	$sql = "UPDATE table_pensiun SET `spp`='{$spp}',`fc_sk_cpns_pns`='{$fc_sk_cpns_pns}',`fc_ktp`='{$fc_ktp}',`foto`='{$foto}', admin = '$proses' WHERE id = '$id'";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_pensiun.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal update pegawai!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pensiun.php');
	}
		
?>

