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
	$sk_kenaikan_pangkat_terakhir = htmlentities(trim( $_POST['sk_kenaikan_pangkat_terakhir'] )) == "on" ? "true" : "false";
	$fc_sk_cpns_pns = htmlentities(trim( $_POST['fc_sk_cpns_pns'] )) == "on" ? "true" : "false";
	$fc_skp = htmlentities(trim( $_POST['fc_skp'] )) == "on" ? "true" : "false";
	$fc_kp = htmlentities(trim( $_POST['fc_kp'] )) == "on" ? "true" : "false";
	
	$sql = "UPDATE table_pangkat SET sk_kenaikan_pangkat_terakhir='$sk_kenaikan_pangkat_terakhir',fc_sk_cpns_pns='$fc_sk_cpns_pns',fc_skp='$fc_skp',fc_kp='$fc_kp', admin = '$proses' WHERE id = '$id'";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_pangkat.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal update pegawai!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pangkat.php');
    }
		
?>

