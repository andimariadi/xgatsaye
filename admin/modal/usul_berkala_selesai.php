<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM proses_usul_berkala WHERE nip = '$nip'");
    $row = mysqli_fetch_array($query);

?> 
    <div class="row">
        <div class="col-12 justify-content-center">

            <form method="post" action="fungsi/usul_berkala_selesai.php" class="text-center pt-3 pb-4">
                <input hidden type="text" name="nip" value="<?= $row['nip']; ?>">
                <input hidden type="text" name="tanggal" value="<?= $row['tanggal']; ?>">
                <input hidden type="text" name="bln_masa_jabatan" value="<?= $row['bln_masa_jabatan']; ?>">


                <input hidden type="text" name="nomor_sk" value="<?= $row['nomor_sk']; ?>">
                <input hidden type="text" name="tanggal_sk" value="<?= $row['tanggal_sk']; ?>">
                <input hidden type="text" name="nama_nip" value="<?= $row['nama_nip']; ?>">
                <input hidden type="text" name="tempat_tgl_lahir" value="<?= $row['tempat_tgl_lahir']; ?>">
                <input hidden type="text" name="pangkat_jabatan" value="<?= $row['pangkat_jabatan']; ?>">
                <input hidden type="text" name="unit_skpd" value="<?= $row['unit_skpd']; ?>">
                <input hidden type="text" name="gaji_pokok_lama" value="<?= $row['gaji_pokok_lama']; ?>">
                <input hidden type="text" name="tanggal_sk_lama" value="<?= $row['tanggal_sk_lama']; ?>">
                <input hidden type="text" name="nomor_sk_lama" value="<?= $row['nomor_sk_lama']; ?>">
                <input hidden type="text" name="tanggal_tmt_lama" value="<?= $row['tanggal_tmt_lama']; ?>">
                <input hidden type="text" name="masa_kerja_lama" value="<?= $row['masa_kerja_lama']; ?>">
                <input hidden type="text" name="gaji_pokok" value="<?= $row['gaji_pokok']; ?>">
                <input hidden type="text" name="masa_jabatan" value="<?= $row['masa_jabatan']; ?>">
                <input hidden type="text" name="kategori" value="<?= $row['kategori']; ?>">
                <input hidden type="text" name="tanggal_tmt" value="<?= $row['tanggal_tmt']; ?>">

                <div class="form-group ml-5 mr-5">
                    <input type="text" class="form-control" name="penerima" placeholder="Masukkan penerima...">
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 140px; height: 40px">
                    <i class="far fa-times-circle"></i>
                    Close
                </button>

                <button type="button submit" value="OK" class="btn btn-warning" style="width: 140px; height: 40px">
                    <i class="fa fa-print"></i>
                    Arsipkan
                </button>

            </form>
        </div>
    </div>
<?php
    };
?>