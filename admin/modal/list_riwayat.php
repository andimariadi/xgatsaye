<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM riwayat_usul_berkala WHERE nip = '$nip'");

?>  
    <div class="row">
        <div class="col-12 justify-content-center">
        	<table class="table table-sm table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle" style="width: 1%" >No</th>
                        <th class="align-middle" style="width: 4%" >Tanggal Usul</th>
                        <th class="align-middle" style="width: 15%" >Kategori</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td class="text-center"><?php echo $row['tanggal_usul']?></td>
                        <td class="text-left"><?php echo $row['kategori']?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    };
?>