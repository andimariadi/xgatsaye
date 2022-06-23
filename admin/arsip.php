<?php
require 'element/header.php';

// Hide Table
$table = '0';

// Tahun
date_default_timezone_set("Asia/Singapore");
$tahun = date("Y");



// Percabangan Query
$unit_kerja_induk = '.: Pilih Tahun Arsip :.';
if (isset($_POST['tanggal_selesai'])) {
    $unit_kerja_induk = $_POST['tanggal_selesai'];

    if ($unit_kerja_induk == 'Semua') {
        $query = "SELECT * FROM riwayat_usul_berkala INNER JOIN data_pegawai ON riwayat_usul_berkala.nip = data_pegawai.nip ORDER BY tanggal_selesai DESC";
        $result = mysqli_query($con, $query);
        $table = '1';
    } else {
        $query = "SELECT * FROM riwayat_usul_berkala INNER JOIN data_pegawai ON riwayat_usul_berkala.nip = data_pegawai.nip WHERE YEAR(tanggal_selesai)=' $unit_kerja_induk' ORDER BY tanggal_selesai DESC";
        $result = mysqli_query($con, $query);
        $table = '1';
    }
};


    // Alert hapus Riwayat
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
        echo '<script>swal("Success", "Riwayat berhasil dihapus !", "success");</script>';
    }
    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '2') {
        echo '<script>swal("Error", "Riwayat gagal dihapus !", "error");</script>';
    }

    $_SESSION['pesan'] = '';
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

                                <!-- [ table pilihan data pegawai ]  -->

                               <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <i class="fas fa-table mr-1"></i>
                                            <h5>Arsip Usul Berkala</h5>
                                        </div>
                                        <div class="card-body table-border-style" style="min-height: 130px;">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <form method="POST">

                                                        <div class="form-group">

                                                            <!-- <label for="unit_kerja_induk">Unit Kerja Induk</label> -->
                                                            <select class="custom-select" id="tanggal_selesai" type="text" name="tanggal_selesai" onchange="this.form.submit();">

                                                                <option value="<?= $unit_kerja_induk ?>"><?= $unit_kerja_induk ?></option>
                                                                <?php
                                                                for ($tahun_arsip = $tahun; $tahun_arsip > 2020; $tahun_arsip--) {
                                                                ?>
                                                                    <option value="<?= $tahun_arsip ?>"><?= $tahun_arsip ?></option>
                                                                <?php }; ?>
                                                                <option value="Semua">Semua</option>
                                                                
                                                            </select>

                                                            <small id="unit_kerja_induk" class="form-text text-muted">Menampilkan Data Arsip berdasarkan Tahun.</small>
                                                        </div>

                                                       

                                                    </form>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                            <!-- Table Data Pegawai -->
                            <?php if ($table == '1') { ?>
                                
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Arsip Usul Berkala</h5>
                                        </div>
                                        <div class="card-body table-border-style">

                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">													
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 10%" >Unit Kerja</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 1%" >Tanggal Pengambilan</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 1%" >Penerima</th>															
                                                            <th class="align-middle" style="background-color: #cecece; width: 6%" >Action</th>
														</tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php
                                                        while ($row = mysqli_fetch_array($result)) {
                                                        ?>                                             
                                                            <tr>
                                                                <td class="text-left"><?php echo $row['nama']?></td>
                                                                <td class="text-left"><?php echo $row['nip']?></td>
                                                                <td class="text-left"><?php echo $row['unit_kerja_induk']?></td>
                                                                <td class="text-left"><?php echo $row['tanggal_selesai']?></td>
                                                                <td class="text-left"><?php echo $row['penerima']?></td>
                                                                <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item hapus_riwayat text-danger" href="#" name="view" value="View" data-id="<?php echo $row['id']; ?>" data-kategori="<?php echo $row['kategori']; ?>">
                                                                            <i class="fas fa-trash"></i>
                                                                            Hapus Arsip
                                                                        </a> 

                                                                        <div class="dropdown-divider"></div>

                                                                           <a class="dropdown-item cetak_sk_arsip" href="#" name="view" value="View" data-nip="<?php echo $row['nip'];?>">
                                                                            <i class="far fa-check-circle"></i>
                                                                            Cetak
                                                                        </a>
       
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>                                                     
                                                    </tbody>
                                                </table>

                                              

                                                <script type="text/javascript">
                                                // Script Modal Cetak SK Arsip
                                                $(document).ready(function(){
                                                    $('.cetak_sk_arsip').click(function(){
                                                        var nip = $(this).data("nip")
                                                        $.ajax({
                                                            url: "modal/cetak_sk_arsip.php",
                                                            method: "POST",
                                                            data: {nip: nip},
                                                            success: function(data){
                                                                $("#cetak_sk_arsip").html(data)
                                                                $("#cetak_sk_arsip_modal").modal('show')
                                                            }
                                                        })
                                                    })
                                                });

                                                // Script Modal Hapus Riwayat
                                                $(document).ready(function(){
                                                    $('.hapus_riwayat').click(function(){
                                                        var id = $(this).data("id")
                                                        var kategori = $(this).data("kategori")
                                                        $.ajax({
                                                            url: "modal/hapus_riwayat.php",
                                                            method: "POST",
                                                            data: {id: id, kategori:kategori},
                                                            success: function(data){
                                                                $("#hapus_riwayat").html(data)
                                                                $("#hapus_riwayat_modal").modal('show')
                                                            }
                                                        })
                                                    })
                                                });
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                                <!-- Modal Cetak SK -->
                                <div id="cetak_sk_arsip_modal" class="modal fade">  
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                        <div class="modal-content">
                                            <div class="modal-header text-center">  
                                                <h4 class="modal-title">Cetak SK Berkala</h4>  
                                            </div>    
                                            <div class="modal-body" id="cetak_sk_arsip">
                                            <!-- Modal Body -->
                                            </div> 
                                        </div>  
                                    </div>  
                                </div>

                                <!-- Modal Hapus Riwayat -->
                                <div id="hapus_riwayat_modal" class="modal fade">  
                                    <div class="modal-dialog">  
                                        <div class="modal-content">   
                                            <div class="modal-body" id="hapus_riwayat">
                                            <!-- Modal Body -->
                                            </div> 
                                        </div>  
                                    </div>  
                                </div>


                                <!-- Modal export exel -->
	                            <!-- <div id="export_excel" class="modal fade">  
	                                <div class="modal-dialog">  
	                                    <div class="modal-content">  
	                                        <div class="modal-header text-center">  
	                                            <h4 class="modal-title">Export Excel</h4>  
	                                        </div>  
	                                        <div class="modal-body">
	                                            <div class="row">
	                                                <div class="col-12 text-center">
	                                                    <form method="post" action="export/export_arsip.php" target="_blank">

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 140px">Dari Tanggal</span>
                                                                </div>
                                                                <input type="date" class="form-control bg-white" name="dari_tanggal" required>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 140px">Sampai Tanggal</span>
                                                                </div>
                                                                <input type="date" class="form-control bg-white" name="sampai_tanggal" required>
                                                            </div>

	                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 110px; height: 40px">
	                                                        <i class="far fa-times-circle"></i>
	                                                            Close
	                                                        </button>

	                                                        <!-- <button type="button submit" value="OK" class="btn btn-warning" style="width: 110px; height: 40px">
	                                                        <i class="far fa-check-circle"></i>
	                                                            Export
	                                                        </button> -->

	                                                    </form>   
	                                                </div>
	                                            </div>
	                                        </div> 
	                                    </div>  
	                                </div>  
	                            </div> 
                      
                            </div>
                            <!-- [ Main Content ] end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->


    
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

<?php
require 'element/footer.php';
?>