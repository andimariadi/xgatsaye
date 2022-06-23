<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM proses_usul_berkala INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip WHERE proses_usul_berkala.nip = '$nip'");
    $row = mysqli_fetch_array($query);

    $query2 = mysqli_query($con,"SELECT * FROM berkas_ajuan_usul_berkala WHERE berkas_ajuan_usul_berkala.nip = '$nip'");
    $data = mysqli_fetch_array($query2);

?>  
    <div class="row">
        <div class="col-12 justify-content-center">
            <form method="post" action="fungsi/edit_usul_berkala.php" class="pt-3 pb-4">

                <input hidden type="text" name="nip" value="<?= $nip ?>">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 155px">Nama & Gelar</span>
                    </div>
                    <?php
                        $gelar_depan = $row['gelar_depan'];
                        $nama = $row['nama'];
                        $gelar_belakang = $row['gelar_belakang'];

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

                        $nama_result = $gelar_depan . $spasi . $nama . $koma . $gelar_belakang;
                    ?>
                    <input readonly type="text" class="form-control bg-white" value="<?= $nama_result; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 155px">NIP</span>
                    </div>
                    <input readonly type="text" class="form-control bg-white" value="<?= $row['nip']; ?>">
                </div>

                
                <h3>Kelengkapan Berkas</h3>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="form" <?php echo $data['form'] == "true" ? "checked" : "";?>>
                    <label class="form-check-label">Form Usul Berkala</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="sk_berkala_terakhir" <?php echo $data['sk_berkala_terakhir'] == "true" ? "checked" : "";?>>
                    <label class="form-check-label">SK Berkala Terakhir</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="sk_pangkat_terakhir" <?php echo $data['sk_pangkat_terakhir'] == "true" ? "checked" : "";?>>
                    <label class="form-check-label">SK Pangkat Terakhir</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="sk_pemangku_jabatan" <?php echo $data['sk_pemangku_jabatan'] == "true" ? "checked" : "";?>>
                    <label class="form-check-label">SK Pemangku Jabatan</label>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 155px">Keterangan</span>
                    </div>
                    <textarea name="keterangan" class="form-control bg-white" aria-label="With textarea"><?= $row['keterangan']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>PROSES</label>
                    <select name="proses" class="form-control">
                        <option>PROSES</option>
                        <option>APPROVE</option>
                        <option>REJECT</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 140px; height: 40px">
                        <i class="far fa-times-circle"></i>
                        Close
                    </button>

                    <button type="button submit" value="OK" class="btn btn-warning" style="width: 140px; height: 40px">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
<?php
    };
?>