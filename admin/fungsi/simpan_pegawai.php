<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php
	require '../../db_con/koneksi.php';

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
	$no_hp = $_POST['no_hp'];

	$tanggal_lahir = $_POST['tanggal_lahir'];
	$tmt_cpns = $_POST['tmt_cpns'];
	$tmt_pns = $_POST['tmt_pns'];
	$tmt_gol_akhir = $_POST['tmt_gol_akhir'];
	$tmt_jabatan_struktural = $_POST['tmt_jabatan_struktural'];
	$tmt_jabatan_fungsional_tertentu = $_POST['tmt_jabatan_fungsional_tertentu'];

	// SQL
	$sql = "INSERT INTO `$db_name`.`data_pegawai` (`nip`, `nama`, `gelar_depan`, `gelar_belakang`, `tempat_lahir`, `tanggal_lahir`, `gol_awal_cpns`, `tmt_cpns`, `tmt_pns`, `jenis_kelamin`, `gol_akhir`, `tmt_gol_akhir`, `thn_masa_kerja`, `bln_masa_kerja`, `tmt_jabatan_struktural`, `nama_jabatan_struktural`, `tmt_jabatan_fungsional_tertentu`, `nama_jabatan_fungsional_tertentu`, `nama_jabatan_fungsional_umum`, `unit_kerja`, `unit_kerja_induk`, `no_hp`) VALUES ('$nip', '$nama', '$gelar_depan', '$gelar_belakang', '$tempat_lahir', '$tanggal_lahir', '$gol_awal_cpns', '$tmt_cpns', '$tmt_pns', '$jenis_kelamin', '$gol_akhir', '$tmt_gol_akhir', '$thn_masa_kerja', '$bln_masa_kerja', '$tmt_jabatan_struktural', '$nama_jabatan_struktural', '$tmt_jabatan_fungsional_tertentu', '$nama_jabatan_fungsional_tertentu', '$nama_jabatan_fungsional_umum', '$unit_kerja', '$unit_kerja_induk', '$no_hp')";
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '1';
		header('location:../data_pegawai.php');
	}
	else
		$_SESSION['pesan'] = '2';
		header('location:../data_pegawai.php');
		
?>