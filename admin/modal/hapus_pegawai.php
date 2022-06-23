<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
     $nip = $_POST["nip"];
?>  
    <div class="row">
        <div class="col-12 justify-content-center text-center pb-2">

            <h1 style="font-size: 100px"><i class="far fa-question-circle"></i></h1>
            <h3 class="pb-2">Konfirmasi Hapus Pegawai !</h3>

            <form method="post" action="fungsi/hapus_pegawai.php?nip=<?= $nip ?>">

            <!-- <button type="button close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->

            <button type="button submit" value="OK" class="btn btn-warning" data-bs-dismiss="modal">Hapus</button>

            </form>

        </div>
    </div>
<?php
    };
?>