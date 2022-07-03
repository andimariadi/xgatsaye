<?php
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
};

include "../../db_con/koneksi.php";

date_default_timezone_set("Asia/Singapore");
$tanggal_selesai = date("Y-m-d");

$tanggal_usul = $_POST['tanggal'];
$tanggal_terbit = $_POST['tanggal_terbit'];
$nip = $_POST['nip'];

$nomor_sk = $_POST['nomor_sk'];
$tanggal_sk = $_POST['tanggal_sk'];
$nama_nip = $_POST['nama_nip'];
$tempat_tgl_lahir = $_POST['tempat_tgl_lahir'];
$pangkat_jabatan = $_POST['pangkat_jabatan'];
$unit_skpd = $_POST['unit_skpd'];
$gaji_pokok_lama = $_POST['gaji_pokok_lama'];
$tanggal_sk_lama = $_POST['tanggal_sk_lama'];
$nomor_sk_lama = $_POST['nomor_sk_lama'];
$tanggal_tmt_lama = $_POST['tanggal_tmt_lama'];
$masa_kerja_lama = $_POST['masa_kerja_lama'];
$gaji_pokok = $_POST['gaji_pokok'];
$masa_jabatan = $_POST['masa_jabatan'];
$bln_masa_jabatan = $_POST['bln_masa_jabatan'];
$kategori = $_POST['kategori'];
$tanggal_tmt = $_POST['tanggal_tmt'];
$penerima = $_POST['penerima'];

	// Folder Personal
	$dir = "../berkas/$kategori/$nip";

	// Hapus File
	$files = glob("$dir/*.pdf");
	foreach ($files as $file) {
	    if (is_file($file))
	    unlink($file);
	};

	// Hapus Folder
	rmdir("$dir");

	// Hapus Berkas (database)
	$hapus1 = mysqli_query($con, "DELETE FROM berkas WHERE nip = '$nip'");

	// Hapus Usul Pangkat
	$hapus = mysqli_query($con, "DELETE FROM proses_usul_berkala WHERE nip = '$nip'");

	// Meinput Ke Table Arsip
	$sql2 = "INSERT INTO `$db_name`.`riwayat_usul_berkala` (`tanggal_usul`, `tanggal_selesai`, `tanggal_terbit`, `nip`, `nomor_sk`, `tanggal_sk`, `nama_nip`, `tempat_tgl_lahir`, `pangkat_jabatan`, `unit_skpd`, `gaji_pokok_lama`, `tanggal_sk_lama`, `nomor_sk_lama`, `tanggal_tmt_lama`, `masa_kerja_lama`, `gaji_pokok`, `masa_jabatan`, `bln_masa_jabatan`, `kategori`, `tanggal_tmt`, `penerima`) VALUES ('$tanggal_usul', '$tanggal_selesai', '$tanggal_terbit','$nip', '$nomor_sk', '$tanggal_sk', '$nama_nip', '$tempat_tgl_lahir', '$pangkat_jabatan', '$unit_skpd', '$gaji_pokok_lama', '$tanggal_sk_lama', '$nomor_sk_lama', '$tanggal_tmt_lama', '$masa_kerja_lama', '$gaji_pokok', '$masa_jabatan', '$bln_masa_jabatan', '$kategori', '$tanggal_tmt', '$penerima')";
	$result2 = mysqli_query($con, $sql2);

	if ($result2) {
		$_SESSION['pesan'] = '1';
		header('location:../usul_berkala.php');
	} else{
		$_SESSION['pesan'] = '2';
		header('location:../usul_berkala.php');
	};
?>