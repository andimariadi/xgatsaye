<?php
require 'element/header.php';

// Hide Table
$table = '0';

// Tahun
date_default_timezone_set("Asia/Singapore");
$tahun = date("Y");
$tahun_pilihan = $tahun;
if(isset($_POST['tanggal_selesai'])) {
    $tahun_pilihan = $_POST['tanggal_selesai'];
    if($_POST['tanggal_selesai'] == 'semua') {
        $query = mysqli_query($con,"SELECT * FROM riwayat_usul_berkala INNER JOIN data_pegawai ON riwayat_usul_berkala.nip = data_pegawai.nip ORDER BY tanggal_selesai DESC");        
    } else {
        $query = mysqli_query($con,"SELECT * FROM riwayat_usul_berkala INNER JOIN data_pegawai ON riwayat_usul_berkala.nip = data_pegawai.nip
        WHERE YEAR(riwayat_usul_berkala.tanggal_selesai) = '".$_POST['tanggal_selesai']."' 
        ORDER BY tanggal_selesai DESC");
        
    }
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                                <!-- [ breadcrumb ] start -->
                                <div class="page-header">
                                    <div class="page-block">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <div class="page-header-title">
                                                    <!-- <h5 class="m-b-10">Database</h5> -->
                                                </div>
                                                <ul class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                                                    <li class="breadcrumb-item" ><a href="#!">Data Arsip</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ breadcrumb ] end -->

                            <!-- [ Main Content ] start -->
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <i class="fas fa-table mr-1"></i>
                                            <h5>Data Arsip</h5>
                                        </div>
                                        <div class="card-body table-border-style" style="min-height: 130px;">
                                            <form method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tahun</label>
                                                        <select class="form-control" name="tanggal_selesai">
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            for ($tahun_arsip = $tahun; $tahun_arsip > 2020; $tahun_arsip--) {
                                                            ?>
                                                                <option value="<?= $tahun_arsip ?>"<?php if($tahun_pilihan == $tahun_arsip) echo " selected";?>><?= $tahun_arsip ?></option>
                                                            <?php }; ?>
                                                            <option value="semua">Semua</option>                                                                
                                                        </select>
                                                        <small class="form-text text-muted">Menampilkan Data Pensiun berdasarkan Tahun.</small>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label>&nbsp;</label><br/>
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(isset($_POST['tanggal_selesai'])) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Daftar Arsip</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <a href="cetak_filter_arsip.php?tahun=<?= $_POST['tanggal_selesai'];?>" class="btn btn-primary">Cetak</a>
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 10%" >Unit Kerja</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 1%" >Tanggal Pengambilan</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 1%" >Penerima</th>
														</tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while($row = mysqli_fetch_array($query)){
                                                    ?>                                                       
													    <tr>
                                                            <td class="text-left"><?php echo $row['nama']?></td>
                                                            <td class="text-left"><?php echo $row['nip']?></td>
                                                            <td class="text-left"><?php echo $row['unit_kerja_induk']?></td>
                                                            <td class="text-left"><?php echo $row['tanggal_selesai']?></td>
                                                            <td class="text-left"><?php echo $row['penerima']?></td>
														</tr>
                                                        <?php $no++; } ?>   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <!-- [ Main Content ] end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?php
require 'element/footer.php';
?>