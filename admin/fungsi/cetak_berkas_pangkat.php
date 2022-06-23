<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
    }
?>
<?php

// Koneksi
include '../../db_con/koneksi.php';

date_default_timezone_set("Asia/Singapore");
$tanggal_sk = date("Y-m-d");

$nip = $_POST['nip'];
$nama_nip = $_POST['nama_nip'];
$unit_skpd = $_POST['unit_skpd'];
$nomor_sk = $_POST['nomor_sk'];
$tempat_tgl_lahir = $_POST['tempat_lahir'] . ', ' . $_POST['tanggal_lahir'];
$pangkat_jabatan = $_POST['pangkat_jabatan'];
$gaji_pokok_lama = $_POST['gaji_pokok_lama'];
$tanggal_sk_lama = $_POST['tanggal_sk_lama'];
$nomor_sk_lama = $_POST['nomor_sk_lama'];
$tanggal_tmt_lama = $_POST['tanggal_tmt_lama'];
$masa_kerja_lama = $_POST['masa_kerja_lama'];
$gaji_pokok = $_POST['gaji_pokok'];
$thn_masa_kerja = $_POST['thn_masa_kerja'];
$bln_masa_kerja = $_POST['bln_masa_kerja'];
$kategori = $_POST['kategori'];
$tanggal_tmt = $_POST['tanggal_tmt'];

// Tahun bulan masa kerja
$thn_bln_masa_kerja = $thn_masa_kerja . ' Tahun ' . $bln_masa_kerja . ' Bulan';

// Ubah format tanggal sk baru
$hari = (int) substr($tanggal_sk, 8, 2);
$bulan = (int) substr($tanggal_sk, 5, 2);
$tahun = (int) substr($tanggal_sk, 0, 4);
$hari = sprintf("%02s", $hari);
$bulan = sprintf("%02s", $bulan);
$tahun = sprintf("%04s", $tahun);
$char = " ";
	// Ubah bulan ke huruf
	if ($bulan == '01') {
      $bulan = 'Januari';
    } elseif ($bulan == '02') {
      $bulan = 'Februari';
    } elseif ($bulan == '03') {
      $bulan = 'Maret';
    } elseif ($bulan == '04') {
      $bulan = 'April';
    } elseif ($bulan == '05') {
      $bulan = 'Mei';
    } elseif ($bulan == '06') {
      $bulan = 'Juni';
    } elseif ($bulan == '07') {
      $bulan = 'Juli';
    } elseif ($bulan == '08') {
      $bulan = 'Agustus';
    } elseif ($bulan == '09') {
      $bulan = 'September';
    } elseif ($bulan == '10') {
      $bulan = 'Oktober';
    } elseif ($bulan == '11') {
      $bulan = 'November';
    } elseif ($bulan == '12') {
      $bulan = 'Desember';
    };
$tanggal_sk_edit = $hari . $char . $bulan . $char . $tahun;

// Ubah format tanggal tmt lama
$hari = (int) substr($tanggal_tmt_lama, 8, 2);
$bulan = (int) substr($tanggal_tmt_lama, 5, 2);
$tahun = (int) substr($tanggal_tmt_lama, 0, 4);
$hari = sprintf("%02s", $hari);
$bulan = sprintf("%02s", $bulan);
$tahun = sprintf("%04s", $tahun);
$char = " ";
	// Ubah bulan ke huruf
	if ($bulan == '01') {
      $bulan = 'Januari';
    } elseif ($bulan == '02') {
      $bulan = 'Februari';
    } elseif ($bulan == '03') {
      $bulan = 'Maret';
    } elseif ($bulan == '04') {
      $bulan = 'April';
    } elseif ($bulan == '05') {
      $bulan = 'Mei';
    } elseif ($bulan == '06') {
      $bulan = 'Juni';
    } elseif ($bulan == '07') {
      $bulan = 'Juli';
    } elseif ($bulan == '08') {
      $bulan = 'Agustus';
    } elseif ($bulan == '09') {
      $bulan = 'September';
    } elseif ($bulan == '10') {
      $bulan = 'Oktober';
    } elseif ($bulan == '11') {
      $bulan = 'November';
    } elseif ($bulan == '12') {
      $bulan = 'Desember';
    };
$tanggal_tmt_lama_edit = $hari . $char . $bulan . $char . $tahun;

// Ubah format tanggal sk lama
$hari = (int) substr($tanggal_sk_lama, 8, 2);
$bulan = (int) substr($tanggal_sk_lama, 5, 2);
$tahun = (int) substr($tanggal_sk_lama, 0, 4);
$hari = sprintf("%02s", $hari);
$bulan = sprintf("%02s", $bulan);
$tahun = sprintf("%04s", $tahun);
$char = " ";
	// Ubah bulan ke huruf
	if ($bulan == '01') {
      $bulan = 'Januari';
    } elseif ($bulan == '02') {
      $bulan = 'Februari';
    } elseif ($bulan == '03') {
      $bulan = 'Maret';
    } elseif ($bulan == '04') {
      $bulan = 'April';
    } elseif ($bulan == '05') {
      $bulan = 'Mei';
    } elseif ($bulan == '06') {
      $bulan = 'Juni';
    } elseif ($bulan == '07') {
      $bulan = 'Juli';
    } elseif ($bulan == '08') {
      $bulan = 'Agustus';
    } elseif ($bulan == '09') {
      $bulan = 'September';
    } elseif ($bulan == '10') {
      $bulan = 'Oktober';
    } elseif ($bulan == '11') {
      $bulan = 'November';
    } elseif ($bulan == '12') {
      $bulan = 'Desember';
    };
$tanggal_sk_lama_edit = $hari . $char . $bulan . $char . $tahun;

// Ubah format tanggal tmt baru
$hari = (int) substr($tanggal_tmt, 8, 2);
$bulan = (int) substr($tanggal_tmt, 5, 2);
$tahun = (int) substr($tanggal_tmt, 0, 4);
$hari = sprintf("%02s", $hari);
$bulan = sprintf("%02s", $bulan);
$tahun = sprintf("%04s", $tahun);
$char = " ";
	// Ubah bulan ke huruf
	if ($bulan == '01') {
      $bulan = 'Januari';
    } elseif ($bulan == '02') {
      $bulan = 'Februari';
    } elseif ($bulan == '03') {
      $bulan = 'Maret';
    } elseif ($bulan == '04') {
      $bulan = 'April';
    } elseif ($bulan == '05') {
      $bulan = 'Mei';
    } elseif ($bulan == '06') {
      $bulan = 'Juni';
    } elseif ($bulan == '07') {
      $bulan = 'Juli';
    } elseif ($bulan == '08') {
      $bulan = 'Agustus';
    } elseif ($bulan == '09') {
      $bulan = 'September';
    } elseif ($bulan == '10') {
      $bulan = 'Oktober';
    } elseif ($bulan == '11') {
      $bulan = 'November';
    } elseif ($bulan == '12') {
      $bulan = 'Desember';
    };
$tanggal_tmt_edit = $hari . $char . $bulan . $char . $tahun;

// Menambah / pada katerogri
$kategori_ubah = str_replace("a","/a",$kategori);
$kategori_ubah = str_replace("b","/b",$kategori_ubah);
$kategori_ubah = str_replace("c","/c",$kategori_ubah);
$kategori_ubah = str_replace("d","/d",$kategori_ubah);
$kategori_ubah = str_replace("e","/e",$kategori_ubah);

// Nama dibawah
$nama_dibawah = str_replace("/","/ NIP. ",$nama_nip);

// Perubahan database

$sql1 = "UPDATE proses_usul_berkala SET nomor_sk = '$nomor_sk', nomor_sk_lama = '$nomor_sk_lama', tanggal_sk = '$tanggal_sk', tanggal_sk_lama = '$tanggal_sk_lama', tanggal_tmt = '$tanggal_tmt', tanggal_tmt_lama = '$tanggal_tmt_lama', masa_kerja_lama = '$masa_kerja_lama', gaji_pokok = '$gaji_pokok', gaji_pokok_lama = '$gaji_pokok_lama', nama_nip = '$nama_nip', pangkat_jabatan = '$pangkat_jabatan', unit_skpd = '$unit_skpd', tempat_tgl_lahir = '$tempat_tgl_lahir', bln_masa_jabatan = '$bln_masa_kerja' WHERE nip = '$nip'";
$result1 = mysqli_query($con, $sql1);

$sql2 = "UPDATE data_pegawai SET thn_masa_kerja = '$thn_masa_kerja' WHERE nip = '$nip'";
$result2 = mysqli_query($con, $sql2);

$angka_nomor_sk = $_POST['angka_nomor_sk'];
if ($angka_nomor_sk != '') {
  $sql3 = "UPDATE setting SET value = '$angka_nomor_sk' WHERE id = 'nomor_sk'";
  $result3 = mysqli_query($con, $sql3);
}

if ($result1 && $result2) {
  if ($kategori == 'Ia' or $kategori == 'Ib' or $kategori == 'Ic' or $kategori == 'Id' or $kategori == 'IIa' or $kategori == 'IIb' or $kategori == 'IIc' or $kategori == 'IId' or $kategori == 'IIIa' or $kategori == 'IIIb' or $kategori == 'IIIc' or $kategori == 'IIId') {
    require '../cetak_sk/cetak_bkd.php';
  } else {
    require '../cetak_sk/cetak_sekda.php';
  };
} else {
  // Gagal
}

?>