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
	
	if($spp == "true" && $fc_sk_cpns_pns == "true" && $fc_ktp == "true" && $foto == "true" && $proses == 'APPROVE') {
		$query_search = mysqli_query($con, "SELECT verifikator_berkala.email FROM `data_pegawai`
		LEFT JOIN verifikator_berkala ON data_pegawai.unit_kerja_induk = verifikator_berkala.skpd
		WHERE data_pegawai.nip = '{$nip}'");
		$row = mysqli_fetch_assoc($query_search);

		$to_email = $row['email'];
		$to_nama = $row['nama'];
		$to_subject = 'Informasi: Pengajuan pensiun telah selesai';
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

