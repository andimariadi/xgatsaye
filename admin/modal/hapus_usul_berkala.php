<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $kategori = $_POST["kategori"];
?>  
    <div class="row">
        <div class="col-12 justify-content-center text-center pb-2">

            <h1 style="font-size: 100px"><i class="far fa-question-circle"></i></h1>
            <h3 class="pb-2">Konfirmasi Hapus Usul Berkala !</h3>

            <form method="post" action="fungsi/hapus_usul_berkala.php?nip=<?= $nip ?>&kategori=<?= $kategori ?>">

                <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 110px; height: 40px">
                    <i class="far fa-times-circle"></i>
                    Close
                </button>

                <button type="button submit" value="OK" class="btn btn-warning" style="width: 110px; height: 40px">
                    <i class="fas fa-trash"></i>
                    Hapus
                </button>

            </form>

        </div>
    </div>
<?php
    };
?>