<?php

require '../../db_con/koneksi.php';

if (isset($_POST["nip"])) {
    $nip = $_POST["nip"];

    // Query data
    $query = mysqli_query($con, "SELECT * FROM riwayat_usul_berkala WHERE nip = '$nip'");
    $row = mysqli_fetch_array($query);

    // Value
    $nomor_sk = $row['nomor_sk'];
    $tanggal_sk = $row['tanggal_sk'];
    $nama_nip = $row['nama_nip'];
    $tempat_tgl_lahir = $row['tempat_tgl_lahir'];
    $pangkat_jabatan = $row['pangkat_jabatan'];
    $unit_skpd = $row['unit_skpd'];
    $gaji_pokok_lama = $row['gaji_pokok_lama'];
    $tanggal_sk_lama = $row['tanggal_sk_lama'];
    $nomor_sk_lama = $row['nomor_sk_lama'];
    $tanggal_tmt_lama = $row['tanggal_tmt_lama'];
    $masa_kerja_lama = $row['masa_kerja_lama'];
    $gaji_pokok = $row['gaji_pokok'];
    $masa_jabatan = $row['masa_jabatan'];
    $bln_masa_jabatan = $row['bln_masa_jabatan'];
    $kategori = $row['kategori'];
    $tanggal_tmt = $row['tanggal_tmt'];


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

    // Ubah format tanggal sk
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

?>

    <div class="row">
        <div class="col-12 justify-content-center">

            <form method="post" target="_blank" action="fungsi/cetak_sk_arsip.php" class="text-center pt-3 pb-4">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Nomor</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="nomor_sk" value="<?= $nomor_sk ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Tanggal SK</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="tanggal_sk" value="<?= $tanggal_sk_edit ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Nama & Gelar / NIP</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="nama_nip" value="<?= $nama_nip; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TTL</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="tempat_tgl_lahir" value="<?= $tempat_tgl_lahir; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Pangkat / Jabatan</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="pangkat_jabatan" value="<?= $pangkat_jabatan ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Kantor / Tempat Tugas </span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="unit_skpd" value="<?= $unit_skpd ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Gaji Pokok Lama </span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="gaji_pokok_lama" value="<?= $gaji_pokok_lama ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Tanggal & Nomor Lama</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="tanggal_nomor_sk_lama" value="<?= $tanggal_sk_lama_edit ?> / <?= $nomor_sk_lama ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Tanggal TMT Lama</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="tanggal_tmt_lama" value="<?= $tanggal_tmt_lama_edit ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Masa Kerja Golongan Lama</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="masa_kerja_lama" value="<?= $masa_kerja_lama ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Gaji Pokok Baru</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="gaji_pokok" value="<?= $gaji_pokok ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn text-left input-group-text" style="background-color: #eff3f6; width: 220px">Berdasarkan Masa Kerja</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="masa_jabatan" value="<?= $masa_jabatan ?>" required>
                    <input readonly type="text" class="form-control bg-white" name="bln_masa_jabatan" value="<?= $bln_masa_jabatan ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Golongan</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" name="kategori" value="<?= $kategori ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="tanggal_tmt" value="<?= $tanggal_tmt_edit ?>" required>
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