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
        $query = mysqli_query($con,"SELECT data_pegawai.*, table_pensiun.id, table_pensiun.tmt_terakhir_jabatan, table_pensiun.tanggal_pensiun, table_pensiun.kategori_pensiun, table_pensiun.admin, table_pensiun.pimpinan, spp, fc_sk_cpns_pns, fc_ktp, foto, file_path FROM table_pensiun INNER JOIN data_pegawai ON table_pensiun.nip = data_pegawai.nip ORDER BY table_pensiun.created_at DESC");
    } else {
        $query = mysqli_query($con,"SELECT data_pegawai.*, table_pensiun.id, table_pensiun.tmt_terakhir_jabatan, table_pensiun.tanggal_pensiun, table_pensiun.kategori_pensiun, table_pensiun.admin, table_pensiun.pimpinan, spp, fc_sk_cpns_pns, fc_ktp, foto, file_path FROM table_pensiun INNER JOIN data_pegawai ON table_pensiun.nip = data_pegawai.nip WHERE YEAR(table_pensiun.created_at) = '".$_POST['tanggal_selesai']."' ORDER BY table_pensiun.created_at DESC");
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
                                                    <li class="breadcrumb-item" ><a href="#!">Data Pensiun</a></li>
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
                                            <h5>Data Pensiun</h5>
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
                                            <h5>Daftar Pengajuan Pensiun</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <a href="cetak_filter_pensiun.php?tahun=<?= $_POST['tanggal_selesai'];?>" class="btn btn-primary">Cetak</a>
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Unit Kerja Induk</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >TMT Terakhir Jabatan</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Tanggal Pensiun</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Kategori Pensiun</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Surat Permohonan Pensiun</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Fotocopy SK CPNS & PNS</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Fotocopy KTP</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Pas Photo 3x4</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Document</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Approval Admin</th>
														</tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while($row = mysqli_fetch_array($query)){
                                                    ?>                                                       
													    <tr>
															<td><?php echo $no; ?></td>
															<td><?php echo $row['nip']?></td>
															<td><?php echo $row['nama']?></td>
														
															<td><?php echo $row['unit_kerja_induk']?></td>
															<td><?php echo $row['tmt_terakhir_jabatan']?></td>
															<td><?php echo $row['tanggal_pensiun']?></td>
															<td><?php echo $row['kategori_pensiun']?></td>
															<td><?php echo $row['spp'] == "true" ? "ADA" : "TIDAK ADA"?></td>
															<td><?php echo $row['fc_sk_cpns_pns'] == "true" ? "ADA" : "TIDAK ADA"?></td>
															<td><?php echo $row['fc_ktp'] == "true" ? "ADA" : "TIDAK ADA"?></td>
															<td><?php echo $row['foto'] == "true" ? "ADA" : "TIDAK ADA"?></td>
															<td><a href="<?=$row['file_path']?>">Lihat document</a></td>
															<td><?php echo $row['admin']?></td>
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