<?php

// Koneksi
include '../../db_con/koneksi.php';


$nama_nip = $_POST['nama_nip'];
$unit_skpd = $_POST['unit_skpd'];
$nomor_sk = $_POST['nomor_sk'];
$tanggal_sk = $_POST['tanggal_sk'];
$tempat_tgl_lahir = $_POST['tempat_tgl_lahir'];
$pangkat_jabatan = $_POST['pangkat_jabatan'];
$gaji_pokok_lama = $_POST['gaji_pokok_lama'];
$tanggal_nomor_sk_lama = $_POST['tanggal_nomor_sk_lama'];
$tanggal_tmt_lama = $_POST['tanggal_tmt_lama'];
$masa_kerja_lama = $_POST['masa_kerja_lama'];
$gaji_pokok = $_POST['gaji_pokok'];
$masa_jabatan = $_POST['masa_jabatan'];
$bln_masa_jabatan = $_POST['bln_masa_jabatan'];
$kategori = $_POST['kategori'];
$tanggal_tmt = $_POST['tanggal_tmt'];

// Tahun bulan masa kerja
$thn_bln_masa_kerja = $masa_jabatan . ' Tahun ' . $bln_masa_jabatan . ' Bulan';


// Menambah / pada katerogri
$kategori_ubah = str_replace("a","/a",$kategori);
$kategori_ubah = str_replace("b","/b",$kategori_ubah);
$kategori_ubah = str_replace("c","/c",$kategori_ubah);
$kategori_ubah = str_replace("d","/d",$kategori_ubah);
$kategori_ubah = str_replace("e","/e",$kategori_ubah);

// Nama dibawah
$nama_dibawah = str_replace("/","/ NIP. ",$nama_nip);


if ($kategori == 'Ia' or $kategori == 'Ib' or $kategori == 'Ic' or $kategori == 'Id' or $kategori == 'IIa' or $kategori == 'IIb' or $kategori == 'IIc' or $kategori == 'IId' or $kategori == 'IIIa' or $kategori == 'IIIb' or $kategori == 'IIIc' or $kategori == 'IIId') {
  require '../cetak_sk/cetak_bkd_arsip.php';
} else {
  require '../cetak_sk/cetak_sekda_arsip.php';
};


?>