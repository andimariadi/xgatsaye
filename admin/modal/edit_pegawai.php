<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM data_pegawai WHERE nip = '$nip'");
    $row = mysqli_fetch_array($query)

?>  
    <div class="row">
        <div class="col-12 justify-content-center text-center">
            <form method="post" action="fungsi/edit_pegawai.php" class="text-center pt-3 pb-4">
                <input hidden type="text" name="nip_lama" value="<?= $row['nip']; ?>">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">NIP</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="nip" required value="<?= $row['nip']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Nama & Gelar</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="gelar_depan" placeholder="Gelar Depan" value="<?= $row['gelar_depan']; ?>">
                    <input type="text" class="form-control bg-white" name="nama" placeholder="Nama" required value="<?= $row['nama']; ?>">
                    <input type="text" class="form-control bg-white" name="gelar_belakang" placeholder="Gelar Belakang" value="<?= $row['gelar_belakang']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TTL</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $row['tempat_lahir']; ?>">
                    <input type="date" class="form-control bg-white" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" for="gol_awal_cpns" style="background-color: #eff3f6; width: 220px">Gol. Awal CPNS</span>
                    </div>
                    <select class="custom-select bg-white" id="gol_awal_cpns" name="gol_awal_cpns">
                        <option value="<?= $row['gol_awal_cpns']; ?>">
                            <?php
                                $gol_awal_cpns = $row['gol_awal_cpns'];
                                if ($gol_awal_cpns == '') {
                                    echo ".: Golongan Awal CPNS :.";
                                }
                                else
                                    echo "$gol_awal_cpns";
                            ?>
                        </option>
                        <option value="IV/a">IV/a</option>
                        <option value="IV/b">IV/b</option>
                        <option value="IV/c">IV/c</option>
                        <option value="IV/d">IV/d</option>
                        <option value="IV/e">IV/e</option>
                        <option value="III/a">III/a</option>
                        <option value="III/b">III/b</option>
                        <option value="III/c">III/c</option>
                        <option value="III/d">III/d</option>
                        <option value="II/a">II/a</option>
                        <option value="II/b">II/b</option>
                        <option value="II/c">II/c</option>
                        <option value="II/d">II/d</option>
                        <option value="I/a">I/a</option>
                        <option value="I/b">I/b</option>
                        <option value="I/c">I/c</option>
                        <option value="I/d">I/d</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT CPNS</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tmt_cpns" value="<?= $row['tmt_cpns']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT PNS</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tmt_pns" value="<?= $row['tmt_pns']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" for="jenis_kelamin" style="background-color: #eff3f6; width: 220px">Jenis Kelamin</span>
                    </div>
                    <select class="custom-select bg-white" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="<?= $row['jenis_kelamin']; ?>">
                            <?php
                                $jenis_kelamin = $row['jenis_kelamin'];
                                if ($jenis_kelamin == 'L') {
                                    echo "Laki-Laki";
                                }
                                elseif ($jenis_kelamin == 'P') {
                                    echo "Perempuan";
                                }
                                else
                                    echo ".: Jenis Kelamin :.";
                            ?>
                        </option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" for="gol_akhir" style="background-color: #eff3f6; width: 220px">Gol. Akhir</span>
                    </div>
                    <select class="custom-select bg-white" id="gol_akhir" name="gol_akhir">
                        <option value="<?= $row['gol_akhir']; ?>"><?= $row['gol_akhir']; ?></option>
                        <option value="I/a">I/a</option>
                        <option value="I/b">I/b</option>
                        <option value="I/c">I/c</option>
                        <option value="I/d">I/d</option>
                        <option value="II/a">II/a</option>
                        <option value="II/b">II/b</option>
                        <option value="II/c">II/c</option>
                        <option value="II/d">II/d</option>
                        <option value="III/a">III/a</option>
                        <option value="III/b">III/b</option>
                        <option value="III/c">III/c</option>
                        <option value="III/d">III/d</option>
                        <option value="IV/a">IV/a</option>
                        <option value="IV/b">IV/b</option>
                        <option value="IV/c">IV/c</option>
                        <option value="IV/d">IV/d</option>
                        <option value="IV/e">IV/e</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT Gol. Akhir</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tmt_gol_akhir" value="<?= $row['tmt_gol_akhir']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Masa Kerja</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="thn_masa_kerja" placeholder="Tahun" value="<?= $row['thn_masa_kerja']; ?>">
                    <input type="text" class="form-control bg-white" name="bln_masa_kerja" placeholder="Bulan" value="<?= $row['bln_masa_kerja']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Jabatan Struktural</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="nama_jabatan_struktural" value="<?= $row['nama_jabatan_struktural']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">TMT Jabatan Struktural</span>
                    </div>
                    <input type="date" class="form-control bg-white" name="tmt_jabatan_struktural" value="<?= $row['tmt_jabatan_struktural']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Jabatan Fungsional Tertentu</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="nama_jabatan_fungsional_tertentu" value="<?= $row['nama_jabatan_fungsional_tertentu']; ?>">
                    <input type="date" class="form-control bg-white" name="tmt_jabatan_fungsional_tertentu" value="<?= $row['tmt_jabatan_fungsional_tertentu']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Jabatan Fungsional Umum</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="nama_jabatan_fungsional_umum" value="<?= $row['nama_jabatan_fungsional_umum']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Unit Kerja</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="unit_kerja" value="<?= $row['unit_kerja']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">Unit Kerja Induk</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="unit_kerja_induk" value="<?= $row['unit_kerja_induk']; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">No HP</span>
                    </div>
                    <input type="text" class="form-control bg-white" name="no_hp" value="<?= $row['no_hp']; ?>">
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 110px; height: 40px">
               
                    Close
                </button>
                
                <button type="button submit" value="OK" class="btn btn-warning" style="width: 110px; height: 40px">
                    
                    Simpan
                </button>
            </form>
        </div>
    </div>
<?php
    };
?>