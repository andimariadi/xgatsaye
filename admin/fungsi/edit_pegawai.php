<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
include '../../db_con/koneksi.php';

$nip_lama = $_POST["nip_lama"];

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$gelar_depan = $_POST['gelar_depan'];
$gelar_belakang = $_POST['gelar_belakang'];
$tempat_lahir = $_POST['tempat_lahir'];
$gol_awal_cpns = $_POST['gol_awal_cpns'];	
$jenis_kelamin = $_POST['jenis_kelamin'];
$gol_akhir = $_POST['gol_akhir'];	
$thn_masa_kerja = $_POST['thn_masa_kerja'];
$bln_masa_kerja = $_POST['bln_masa_kerja'];
$nama_jabatan_struktural = $_POST['nama_jabatan_struktural'];	
$nama_jabatan_fungsional_tertentu = $_POST['nama_jabatan_fungsional_tertentu'];
$nama_jabatan_fungsional_umum = $_POST['nama_jabatan_fungsional_umum'];
$unit_kerja = $_POST['unit_kerja'];
$unit_kerja_induk = $_POST['unit_kerja_induk'];
$instansi_induk = $_POST['instansi_induk'];
$instansi_kerja = $_POST['instansi_kerja'];
$no_hp = $_POST['no_hp'];

$tanggal_lahir = $_POST['tanggal_lahir'];
$tmt_cpns = $_POST['tmt_cpns'];
$tmt_pns = $_POST['tmt_pns'];
$tmt_gol_akhir = $_POST['tmt_gol_akhir'];
$tmt_jabatan_struktural = $_POST['tmt_jabatan_struktural'];
$tmt_jabatan_fungsional_tertentu = $_POST['tmt_jabatan_fungsional_tertentu'];

$perhitungan_proses = mysqli_query($con,"SELECT * FROM proses_usul_berkala WHERE nip = $nip_lama");
$proses = mysqli_num_rows($perhitungan_proses);

$perhitungan_riwayat = mysqli_query($con,"SELECT * FROM riwayat_usul_berkala WHERE nip = $nip_lama");
$riwayat = mysqli_num_rows($perhitungan_riwayat);

$perhitungan_berkas = mysqli_query($con,"SELECT * FROM berkas WHERE nip = $nip_lama");
$berkas = mysqli_num_rows($perhitungan_berkas);

	$sql = "UPDATE data_pegawai SET nip = '$nip', nama = '$nama', gelar_depan = '$gelar_depan', gelar_belakang = '$gelar_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gol_awal_cpns = '$gol_awal_cpns', tmt_cpns = '$tmt_cpns', tmt_pns = '$tmt_pns', jenis_kelamin = '$jenis_kelamin', gol_akhir = '$gol_akhir', tmt_gol_akhir = '$tmt_gol_akhir', thn_masa_kerja = '$thn_masa_kerja', bln_masa_kerja = '$bln_masa_kerja', tmt_jabatan_struktural = '$tmt_jabatan_struktural', nama_jabatan_struktural = '$nama_jabatan_struktural', tmt_jabatan_fungsional_tertentu = '$tmt_jabatan_fungsional_tertentu', nama_jabatan_fungsional_tertentu = '$nama_jabatan_fungsional_tertentu', nama_jabatan_fungsional_umum = '$nama_jabatan_fungsional_umum', unit_kerja = '$unit_kerja', unit_kerja_induk = '$unit_kerja_induk', no_hp = '$no_hp' WHERE nip = '$nip_lama'";

	$result = mysqli_query($con, $sql);
	if($result){
		$_SESSION['pesan'] = '3';
		header('location:../data_pegawai.php');
	}
	else
		$_SESSION['pesan'] = '4';
		header('location:../data_pegawai.php');

	if ($nip_lama !== $nip) {
		if ($proses !== '0') {
			$sql1 = "UPDATE proses_naik_pangkat SET nip = '$nip' WHERE nip = '$nip_lama'";
			$result1 = mysqli_query($con, $sql1);
		};

		if ($riwayat !== '0') {
			$sql2 = "UPDATE riwayat_naik_pangkat SET nip = '$nip' WHERE nip = '$nip_lama'";
			$result2 = mysqli_query($con, $sql2);
		};

		if ($berkas !== '0') {
			$sql3 = "UPDATE berkas SET nip = '$nip' WHERE nip = '$nip_lama'";
			$result3 = mysqli_query($con, $sql3);
		};
	};

?>
