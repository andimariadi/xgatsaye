<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
	require '../../db_con/koneksi.php';

	$nip 			= $_POST['nip'];
	$keterangan 	= $_POST['keterangan'];
	$proses 				= htmlentities(trim( $_POST['proses'] ));
	$form 					= htmlentities(trim( $_POST['form'] )) == "on" ? "true" : "false";
	$sk_berkala_terakhir 	= htmlentities(trim( $_POST['sk_berkala_terakhir'] )) == "on" ? "true" : "false";
	$sk_pangkat_terakhir 	= htmlentities(trim( $_POST['sk_pangkat_terakhir'] )) == "on" ? "true" : "false";
	$sk_pemangku_jabatan 	= htmlentities(trim( $_POST['sk_pemangku_jabatan'] )) == "on" ? "true" : "false";

	if($form == "true" && $sk_berkala_terakhir == "true" && $sk_pangkat_terakhir == "true" && $sk_pemangku_jabatan == "true"  && $proses == 'APPROVE') {
		$query_search = mysqli_query($con, "SELECT verifikator_berkala.email FROM `data_pegawai`
		LEFT JOIN verifikator_berkala ON data_pegawai.unit_kerja_induk = verifikator_berkala.skpd
		WHERE data_pegawai.nip = '{$nip}'");
		$row = mysqli_fetch_assoc($query_search);

		$to_email = $row['email'];
		$to_nama = $row['nama'];
		$to_subject = 'Informasi: Pengajuan usul berkala telah selesai';
		$to_body = "Hallo {$row['nama']} , kami informasikan bahwa berkas Anda telah selesai diproses. Silahkan ambil berkas Anda ke BKPSDM Tapin. Terima kasih.";

		require '../../plugins/kirim.php';
	}

	
	$sql = "UPDATE proses_usul_berkala SET  keterangan = '$keterangan' WHERE nip = '$nip'";
	$result = mysqli_query($con, $sql);

	$sql = "UPDATE berkas_ajuan_usul_berkala SET form='$form',sk_berkala_terakhir='$sk_berkala_terakhir',sk_pangkat_terakhir='$sk_pangkat_terakhir',sk_pemangku_jabatan='$sk_pemangku_jabatan', keterangan = '$keterangan', `admin` = '$proses' WHERE nip = '$nip'";
	
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '3';
		header('location:../usul_berkala.php');
	}
	else
		$_SESSION['pesan'] = '4';
		header('location:../usul_berkala.php');
		
?>

