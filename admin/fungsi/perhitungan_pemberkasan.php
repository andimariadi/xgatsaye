<?php
	$query1 = "SELECT nip FROM proses_usul_berkala WHERE pemberkasan_status = 'Berkas Masuk'";
    $result1 = mysqli_query($con, $query1);
    $berkas_masuk = mysqli_num_rows($result1);

    $query2 = "SELECT nip FROM proses_usul_berkala WHERE pemberkasan_status = 'Belum Lengkap'";
    $result2 = mysqli_query($con, $query2);
    $belum_lengkap = mysqli_num_rows($result2);

    $query3 = "SELECT nip FROM proses_usul_berkala WHERE pemberkasan_status = 'Lengkap'";
    $result3 = mysqli_query($con, $query3);
    $berkas_lengkap = mysqli_num_rows($result3);

    $query4 = "SELECT nip FROM proses_usul_berkala WHERE pemberkasan_status = 'Belum Mengisi'";
    $result4 = mysqli_query($con, $query4);
    $belum_mengisi = mysqli_num_rows($result4);

    $query5 = "SELECT nip FROM ajuan_usul_berkala";
    $result5 = mysqli_query($con, $query5);
    $ajuan_masuk = mysqli_num_rows($result5);

    $query6 = "SELECT nip FROM proses_usul_berkala";
    $result6 = mysqli_query($con, $query6);
    $proses_berkalaa = mysqli_num_rows($result6);

    $query7 = "SELECT nip FROM riwayat_usul_berkala";
    $result7 = mysqli_query($con, $query7);
    $arsipp = mysqli_num_rows($result7);
    
    $query8 = "SELECT id FROM `table_pensiun` WHERE admin = 'proses'";
    $result8 = mysqli_query($con, $query8);
    $pengsiun = mysqli_num_rows($result8);
    
    $query9 = "SELECT id FROM `table_pangkat` WHERE admin = 'proses'";
    $result9 = mysqli_query($con, $query9);
    $pangkat = mysqli_num_rows($result9);
?>
