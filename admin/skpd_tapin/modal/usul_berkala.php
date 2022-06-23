<?php

require '../../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $no_hp = $_POST["no_hp"];

?>  
    <div class="row">
        <div class="col-12 justify-content-center text-center">
            <form method="post" action="fungsi/usul_berkala.php" class="text-center pt-3 pb-4">
                <input type="hidden" value="<?= $no_hp ?>" name="no_hp_lama">
                <input type="hidden" value="<?= $nip ?>" name="nip">


                <div class="input-group mt-1 mb-1">
                    <input type="hidden"  name="nip" value="<?= $nip; ?>">
                </div>

                <h4 class="mb-4">Pilih Usul Berkala</h4>  

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">No HP</span>
                    </div>
                    <input type="number" class="form-control bg-white" name="no_hp_baru" value="<?= $no_hp ?>" required>
                </div>
                
                
                
                <div class="form-group">
                    <label>Dokumen Persyaratan</label>
                    <input type="file" name="document" placeholder="Dokumen Persyaratan" class="form-control" />
                    <p class="help-block">Gabungkan file yang akan diupload</p>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 130px; height: 40px">
                    <i class="far fa-times-circle"></i>
                    Close
                </button>
                <button type="button submit" value="OK" class="btn btn-warning" style="width: 130px; height: 40px">
                    <i class="fas fa-user-check"></i>
                    Proses
                </button>
            </form>
        </div>
    </div>
<?php
    };
?>