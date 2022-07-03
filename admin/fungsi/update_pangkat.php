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
	
	if($sk_kenaikan_pangkat_terakhir == "true" && $fc_sk_cpns_pns == "true" && $fc_skp == "true" && $fc_kp == "true" && $proses == 'APPROVE') {
		$query_search = mysqli_query($con, "SELECT verifikator_berkala.email FROM `data_pegawai`
		LEFT JOIN verifikator_berkala ON data_pegawai.unit_kerja_induk = verifikator_berkala.skpd
		WHERE data_pegawai.nip = '{$nip}'");
		$row = mysqli_fetch_assoc($query_search);

		$to_email = $row['email'];
		$to_nama = $row['nama'];
		$to_subject = 'Informasi: Pengajuan pangkat telah selesai';
		$to_body = "Hallo {$row['nama']} , kami informasikan bahwa berkas Anda telah selesai diproses. Terima kasih.";

		require '../../plugins/kirim.php';
	}

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

