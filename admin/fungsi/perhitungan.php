<?php

    date_default_timezone_set("Asia/Singapore");
    $tahun = date("Y");

    $query1 = "SELECT nip FROM proses_usul_berkala WHERE pemberkasan_status = 'Berkas Masuk'";
    $result1 = mysqli_query($con, $query1);
    $pemberkasan = mysqli_num_rows($result1);

    $query2 = "SELECT nip FROM ajuan_usul_berkala";
    $result2 = mysqli_query($con, $query2);
    $ajuan = mysqli_num_rows($result2);

    $query3 = "SELECT nip FROM proses_usul_berkala";
    $result3 = mysqli_query($con, $query3);
    $proses = mysqli_num_rows($result3);

    $query4 = "SELECT nip FROM riwayat_usul_berkala WHERE YEAR(tanggal_usul)='$tahun'";
    $result4 = mysqli_query($con, $query4);
    $riwayat = mysqli_num_rows($result4);

    $query5 = "SELECT nip FROM data_pegawai";
    $result5 = mysqli_query($con, $query5);
    $pegawai = mysqli_num_rows($result5);

    // $query6 = "SELECT nip FROM data_pegawai ";
    // $result6 = mysqli_query($con, $query6);
    // $pegawai = mysqli_num_rows($result6);

   
?>