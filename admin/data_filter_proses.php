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
        $query = mysqli_query($con,"SELECT proses_usul_berkala.tanggal, proses_usul_berkala.nip, data_pegawai.nama, data_pegawai.gol_akhir, data_pegawai.unit_kerja_induk, proses_usul_berkala.keterangan, proses_usul_berkala.keterangan, proses_usul_berkala.kategori, berkas_ajuan_usul_berkala.form, berkas_ajuan_usul_berkala.sk_berkala_terakhir, berkas_ajuan_usul_berkala.sk_pangkat_terakhir, berkas_ajuan_usul_berkala.sk_pemangku_jabatan, berkas_ajuan_usul_berkala.file_path, berkas_ajuan_usul_berkala.admin
        FROM proses_usul_berkala 
        INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip 
        LEFT JOIN berkas_ajuan_usul_berkala ON berkas_ajuan_usul_berkala.nip = proses_usul_berkala.nip
        ORDER BY tanggal DESC");        
    } else {
        $query = mysqli_query($con,"SELECT proses_usul_berkala.tanggal, proses_usul_berkala.nip, data_pegawai.nama, data_pegawai.gol_akhir, data_pegawai.unit_kerja_induk, proses_usul_berkala.keterangan, proses_usul_berkala.keterangan, proses_usul_berkala.kategori, berkas_ajuan_usul_berkala.form, berkas_ajuan_usul_berkala.sk_berkala_terakhir, berkas_ajuan_usul_berkala.sk_pangkat_terakhir, berkas_ajuan_usul_berkala.sk_pemangku_jabatan, berkas_ajuan_usul_berkala.file_path, berkas_ajuan_usul_berkala.admin
        FROM proses_usul_berkala 
        INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip 
        LEFT JOIN berkas_ajuan_usul_berkala ON berkas_ajuan_usul_berkala.nip = proses_usul_berkala.nip 
        WHERE YEAR(proses_usul_berkala.tanggal) = '".$_POST['tanggal_selesai']."' 
        ORDER BY tanggal DESC");
        
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
                                                    <li class="breadcrumb-item" ><a href="#!">Data Proses Berkala</a></li>
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
                                            <h5>Data Proses Berkala</h5>
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
                                            <h5>Daftar Proses Berkala</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <a href="cetak_filter_proses.php?tahun=<?= $_POST['tanggal_selesai'];?>" class="btn btn-primary">Cetak</a>
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
                                                            <th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 5%" >Tanggal</th>	
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>		
                                                            <th class="align-middle" style="background-color: #cecece; width: 5%" >Pangkat</th>                                                         
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Unit Kerja Induk</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Form Usul Berkala</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >SK Berkala Terakhir</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >SK Pangkat Terakhir</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >SK Pemangku Jabatan</th>
                                                            <th class="align-middle" style="background-color: #cecece; max-width: 15%">Document</th>
                                                            <th class="align-middle" style="background-color: #cecece; max-width: 15%">Keterangan</th>
                                                            <th class="align-middle" style="background-color: #cecece; max-width: 15%">Admin</th>
														</tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while($row = mysqli_fetch_array($query)){
                                                    ?>                                                       
													    <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $row['tanggal']?></td>
															<td><?php echo $row['nama']?></td>
															<td><?php echo $row['nip']?></td>
															<td><?php echo $row['kategori']?></td>
															<td><?php echo $row['unit_kerja_induk']?></td>
															<td><?php echo $row['form'] == "true" ? "ADA" : "TIDAK ADA";?></td>
															<td><?php echo $row['sk_berkala_terakhir'] == "true" ? "ADA" : "TIDAK ADA";?></td>
															<td><?php echo $row['sk_pangkat_terakhir'] == "true" ? "ADA" : "TIDAK ADA";?></td>
															<td><?php echo $row['sk_pemangku_jabatan'] == "true" ? "ADA" : "TIDAK ADA";?></td>
															<td><a href="<?=$row['file_path']?>">Lihat document</a></td>
                                                            <td><?php echo $row['keterangan']?></td>
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