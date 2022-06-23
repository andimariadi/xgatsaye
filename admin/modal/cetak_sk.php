<?php

require '../../db_con/koneksi.php';

if (isset($_POST["nip"])) {
    $nip = $_POST["nip"];

    // Query data
    $query = mysqli_query($con, "SELECT * FROM proses_usul_berkala INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip WHERE proses_usul_berkala.nip = '$nip'");
    $row = mysqli_fetch_array($query);

    // Query data gajih
    $kategori = $row['kategori'];
    $masa_jabatan = $row['masa_jabatan'];
    echo "SELECT * FROM table_gajih WHERE pangkat = '$kategori' AND masa_jabatan = '$masa_jabatan'";
    $query1 = mysqli_query($con, "SELECT * FROM table_gajih WHERE pangkat = '$kategori' AND masa_jabatan = '$masa_jabatan'");
    $row1 = mysqli_fetch_array($query1);
    if ($row1) {
        $gaji_pokok = $row1['gaji_pokok'];
        $golongan = $row1['golongan'];
    } else {
        $gaji_pokok = 'Error';
        $golongan = 'Error';
    };

    // Query gaji pokok lama
    $masa_jabatan_lama = $masa_jabatan - 2;
    $query3 = mysqli_query($con, "SELECT * FROM table_gajih WHERE pangkat = '$kategori' AND masa_jabatan = '$masa_jabatan_lama'");
    $row2 = mysqli_fetch_array($query3);
    if ($row2) {
        $gaji_pokok_lama = $row2['gaji_pokok'];
    } else {
        $gaji_pokok_lama = '';
    };



    // Merubah kategori
    $kategori = $row['kategori'];
    $kategori = substr($kategori, 0, -1);
    if ($kategori == 'I') {
        $angka_kategori = '1';
    } else if ($kategori == 'II') {
        $angka_kategori = '2';
    } else if ($kategori == 'III') {
        $angka_kategori = '3';
    } else if ($kategori == 'IV') {
        $angka_kategori = '4';
    };

    // No cetak sk
    $nomor_sk = $row['nomor_sk'];
    $angka_nomor_sk = '';
    if ($nomor_sk == '') {
        $query2 = mysqli_query($con, "SELECT max(value) as nomor_sk FROM setting WHERE id = 'nomor_sk'");
        $data = mysqli_fetch_array($query2);
        $nomor_sk = $data['nomor_sk'];
        $nomor_sk++;
        $nomor_sk = sprintf("%04s", $nomor_sk);
        $angka_nomor_sk = $nomor_sk;
        $nomor_sk = '822.' . $angka_kategori . '/ ' . $nomor_sk . '-Dapeninfo/BKPSDM';
    };

    // pangkat / jabatan
    if ($row['nama_jabatan_struktural'] != '') {
        $jabatan = $row['nama_jabatan_struktural'];
    } elseif ($row['nama_jabatan_fungsional_tertentu'] != '') {
        $jabatan = $row['nama_jabatan_fungsional_tertentu'];
    } elseif ($row['nama_jabatan_fungsional_umum'] != '') {
        $jabatan = $row['nama_jabatan_fungsional_umum'];
    };

    // no sk lama
    if ($row['nomor_sk_lama'] != '') {
        $nomor_sk_lama = $row['nomor_sk_lama'];
    } else {
        $nomor_sk_lama = '822.' . $angka_kategori . '/ 0000-Dapeninfo/BKPSDM';
    };

    // Masa jabatan lama
    $masa_jabatan_lama = $row['masa_kerja_lama'];
    if ($masa_jabatan_lama == '') {
        $masa_jabatan_lama = $masa_jabatan - 2 . ' Tahun 00 Bulan';
    } else {
        $masa_jabatan_lama = $row['masa_kerja_lama'];
    }

    // Ubah format tanggal lahir
    $tanggal_lahir = $row['tanggal_lahir'];
    $hari = (int) substr($tanggal_lahir, 8, 2);
    $bulan = (int) substr($tanggal_lahir, 5, 2);
    $tahun = (int) substr($tanggal_lahir, 0, 4);
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
    $tanggal_lahir = $hari . $char . $bulan . $char . $tahun;
?>

    <div class="row">
        <div class="col-12 justify-content-center">

            <form method="post" target="_blank" action="fungsi/cetak_sk.php" class="text-center pt-3 pb-4">

                <input hidden type="text" name="nip" value="<?= $nip ?>">
                <input hidden type="text" name="angka_nomor_sk" value="<?= $angka_nomor_sk ?>">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Nomor</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="nomor_sk" value="<?= $nomor_sk ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Nama & Gelar / NIP</span>
                    </div>
                    <?php
                    $gelar_depan = $row['gelar_depan'];
                    $nama = $row['nama'];
                    $gelar_belakang = $row['gelar_belakang'];
                    $nip = $row['nip'];

                    if ($gelar_depan == '') {
                        $spasi = '';
                    } else {
                        $spasi = ' ';
                    };

                    if ($gelar_belakang == '') {
                        $koma = '';
                    } else {
                        $koma = ', ';
                    };

                    if ($nip == '') {
                        $miring = '';
                    } else {
                        $miring = '  / ';
                    };

                    $nama_result = $gelar_depan . $spasi . $nama . $koma . $gelar_belakang . $miring . $nip;
                    ?>
                    <input readonly type="text" class="form-control bg-white" name="nama_nip" value="<?= $nama_result; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TTL</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $row['tempat_lahir']; ?>" required>
                    <input readonly type="text" class="form-control bg-white" name="tanggal_lahir" value="<?= $tanggal_lahir; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Pangkat / Jabatan</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="pangkat_jabatan" value="<?= $golongan ?> / <?= $jabatan ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Kantor / Tempat Tugas </span>
                    </div>
                    <input type="text" class="form-control bg-white" name="unit_skpd" value="<?= $row['unit_kerja_induk']; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Gaji Pokok Lama </span>
                    </div>
                    <input type="text" class="form-control bg-white" name="gaji_pokok_lama" value="Rp <?= $gaji_pokok_lama ?> " placeholder="Masukkan Gaji Lama" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Tanggal & Nomor Lama</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tanggal_sk_lama" value="<?= $row['tanggal_sk_lama']; ?>" required>
                    <input type="text" class="form-control bg-white" name="nomor_sk_lama" value="<?= $nomor_sk_lama ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Tanggal TMT Lama</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tanggal_tmt_lama" value="<?= $row['tanggal_tmt_lama']; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Masa Kerja Golongan Lama</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="masa_kerja_lama" value="<?= $masa_jabatan_lama; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Gaji Pokok Baru</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="gaji_pokok" value="Rp <?= $gaji_pokok ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn text-left input-group-text" style="background-color: #eff3f6; width: 220px">Berdasarkan Masa Kerja</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="thn_masa_kerja" value="<?= $row['masa_jabatan']; ?>" required>
                    <input type="text" class="form-control bg-white" name="bln_masa_kerja" value="<?= $row['bln_masa_jabatan']; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Golongan</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="kategori" value="<?= $row['kategori']; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tanggal_tmt" value="<?= $row['tanggal_tmt']; ?>" required>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 140px; height: 40px">
                    <i class="far fa-times-circle"></i>
                    Close
                </button>

                <button type="button submit" value="OK" class="btn btn-warning" style="width: 140px; height: 40px">
                    <i class="fa fa-print"></i>
                    Print
                </button>

            </form>
        </div>
    </div>
<?php
};
?>