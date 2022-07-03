<?php
require 'element/header.php';

$query = "SELECT proses_usul_berkala.tanggal, proses_usul_berkala.nip, data_pegawai.nama, data_pegawai.gol_akhir, data_pegawai.unit_kerja_induk, proses_usul_berkala.keterangan, proses_usul_berkala.keterangan, proses_usul_berkala.kategori, berkas_ajuan_usul_berkala.form, berkas_ajuan_usul_berkala.sk_berkala_terakhir, berkas_ajuan_usul_berkala.sk_pangkat_terakhir, berkas_ajuan_usul_berkala.sk_pemangku_jabatan, berkas_ajuan_usul_berkala.file_path_form, berkas_ajuan_usul_berkala.file_path_sk_berkala, berkas_ajuan_usul_berkala.file_path_sk_pangkat, berkas_ajuan_usul_berkala.file_path_sk_jabatan, berkas_ajuan_usul_berkala.admin
FROM proses_usul_berkala 
INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip 
LEFT JOIN berkas_ajuan_usul_berkala ON berkas_ajuan_usul_berkala.nip = proses_usul_berkala.nip
ORDER BY tanggal DESC";
$result = mysqli_query($con, $query);

// Sweetalert

// Alert Hapus Usul Berkala
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '5') {
    echo '<script>swal("Success", "Berhasil Dihapus!", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '6') {
    echo '<script>swal("Error", "Gagal Dihapus!", "error");</script>';
}

// Alert Edit Keterangan
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '3') {
    echo '<script>swal("Success", "Berhasil disimpan!", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '4') {
    echo '<script>swal("Error", "Gagal Ditambahkan!", "error");</script>';
}

// Alert Arsip Usul Berkala
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
    echo '<script>swal("Success", "Berhasil di arsipkan !", "success");</script>';
}
elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '2') {
    echo '<script>swal("Error", "Gagal diarsipkan, coba lagi !", "error");</script>';
};
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
                                                    <li class="breadcrumb-item" ><a href="#!">Menu</a></li>
                                                    <li class="breadcrumb-item" ><a href="#!">Data Usul Berkala</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ breadcrumb ] end -->

                        <!-- [ Main Content ] start -->
                        <div class="row">
                                <!-- <div class="col-md-3 justify-content-end">
									<div class="card">
										<div class="card-body">
											<h6>Token Belum Dikirim</h6>
											<button type="button" class="btn btn-gradient-secondary btn-sm">Action</button>
										</div>
									</div>
								</div>

								<div class="col-md-3 justify-content-end">
									<div class="card">
										<div class="card-body">
                                            <h6>Token Sudah Dikirim</h6>
											<button type="button" class="btn btn-gradient-warning btn-sm">Action</button>
										</div>
									</div>
								</div>

                                
								<div class="col-md-3 justify-content-end">
									<div class="card">
										<div class="card-body">
                                            <h6>Sudah Pernah Di Cetak</h6>
											<button type="button" class="btn btn-gradient-light btn-sm">Action</button>
										</div>
									</div>
								</div> -->

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Data Usul Berkala</h5>
                                        </div>
                                        <div class="card-body table-border-style">

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
                                                            <th class="align-middle" style="background-color: #cecece; width: 6%" >Action</th>
														</tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $no = 1;
                                                            while($row = mysqli_fetch_array($result)){
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
															<td>
                                                                <a href="<?= base_url($row['file_path_form']);?>">Document Form Usul Berkala</a><br />
                                                                <a href="<?= base_url($row['file_path_sk_berkala']);?>">Document SK Berkala Terakhir</a><br />
                                                                <a href="<?= base_url($row['file_path_sk_pangkat']);?>">Document SK Pangkat Terakhir</a><br />
                                                                <a href="<?= base_url($row['file_path_sk_jabatan']);?>">Document SK Pemangku Jabatan</a><br />
                                                            </td>
                                                            <td><?php echo $row['keterangan']?></td>
                                                            <td><?php echo $row['admin']?></td>
															
															<td class="text-center align-middle">
                                                              
                                                                <div class="dropdown">
                                                                <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                        <div class="dropdown-divider"></div>

                                                                        <a class="dropdown-item edit_usul_berkala" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="far fa-edit"></i>
                                                                            Edit
                                                                        </a>

                                                                        <a class="dropdown-item detail_usul_berkala" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="far fa-eye"></i>
                                                                            Detail
                                                                        </a>

                                                                        <a class="dropdown-item cetak_sk" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fa fa-print"></i>
                                                                            Print
                                                                        </a>

                                                                        <a class="dropdown-item hapus_usul_berkala text-danger" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>" data-kategori="<?php echo $row['kategori']; ?>">
                                                                            <i class="fas fa-trash"></i>
                                                                            Hapus
                                                                        </a>

                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item usul_berkala_selesai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Selesai (Arsipkan)
                                                                        </a> 

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr> 
                                                        <?php $no++; } ?>                 
                                                    </tbody>
                                                    <script type="text/javascript">
                                                        // Script Modal Kirim Token
                                                        // $(document).ready(function(){
                                                        //     $('.kirim-token').click(function(){
                                                        //         var nip = $(this).data("nip")
                                                        //         $.ajax({
                                                        //             url: "modal/kirim_token.php",
                                                        //             method: "POST",
                                                        //             data: {nip: nip},
                                                        //             success: function(data){
                                                        //                 $("#kirim_token").html(data)
                                                        //                 $("#kirim_token_modal").modal('show')
                                                        //             }
                                                        //         })
                                                        //     })
                                                        // });

                                                         // Script Modal Kirim Selesai
                                                         $(document).ready(function(){
                                                            $('.kirim-selesai').click(function(){
                                                                var nip = $(this).data("nip")
                                                                $.ajax({
                                                                    url: "modal/kirim_selesai.php",
                                                                    method: "POST",
                                                                    data: {nip: nip},
                                                                    success: function(data){
                                                                        $("#kirim_selesai").html(data)
                                                                        $("#kirim_selesai_modal").modal('show')
                                                                    }
                                                                })
                                                            })
                                                        });

                                                        // Script Modal Detail Usul Berkala
                                                        $(document).ready(function(){
                                                            $('.detail_usul_berkala').click(function(){
                                                                var nip = $(this).data("nip")
                                                                $.ajax({
                                                                    url: "modal/detail_usul_berkala.php",
                                                                    method: "POST",
                                                                    data: {nip: nip},
                                                                    success: function(data){
                                                                        $("#detail_usul_berkala").html(data)
                                                                        $("#detail_usul_berkala_modal").modal('show')
                                                                    }
                                                                })
                                                            })
                                                        });

                                                        // Script Modal Edit Usul Berkala
                                                        $(document).ready(function(){
                                                            $('.edit_usul_berkala').click(function(){
                                                                var nip = $(this).data("nip")
                                                                $.ajax({
                                                                    url: "modal/edit_usul_berkala.php",
                                                                    method: "POST",
                                                                    data: {nip: nip},
                                                                    success: function(data){
                                                                        $("#edit_usul_berkala").html(data);
                                                                        $("#edit_usul_berkala_modal").modal('show');
                                                                    }
                                                                })
                                                            })
                                                        });

                                                        
                                                        // Script Modal Cetak SK
                                                        $(document).ready(function(){
                                                            $('.cetak_sk').click(function(){
                                                                var nip = $(this).data("nip")
                                                                $.ajax({
                                                                    url: "modal/cetak_sk.php",
                                                                    method: "POST",
                                                                    data: {nip: nip},
                                                                    success: function(data){
                                                                        $("#cetak_sk").html(data)
                                                                        $("#cetak_sk_modal").modal('show')
                                                                    }
                                                                })
                                                            })
                                                        });

                                                        // Script Modal Hapus Usul Berkala
                                                        $(document).ready(function(){
                                                            $('.hapus_usul_berkala').click(function(){
                                                                var nip = $(this).data("nip")
                                                                var kategori = $(this).data("kategori")
                                                                $.ajax({
                                                                    url: "modal/hapus_usul_berkala.php",
                                                                    method: "POST",
                                                                    data: {nip: nip, kategori:kategori},
                                                                    success: function(data){
                                                                        $("#hapus_usul_berkala").html(data)
                                                                        $("#hapus_usul_berkala_modal").modal('show')
                                                                    }
                                                                })
                                                            })
                                                        });

                                                        // Script Modal Arsip Berkala
                                                        $(document).ready(function(){
                                                            $('.usul_berkala_selesai').click(function(){
                                                                var nip = $(this).data("nip")
                                                                $.ajax({
                                                                    url: "modal/usul_berkala_selesai.php",
                                                                    method: "POST",
                                                                    data: {nip: nip},
                                                                    success: function(data){
                                                                        $("#usul_berkala_selesai").html(data)
                                                                        $("#usul_berkala_selesai_modal").modal('show')
                                                                    }
                                                                })
                                                            })
                                                        });
                                                    </script>

                                                </table>
                                            

                                                <!-- Modal Kirim Token -->
                                                <!-- <div id="kirim_token_modal" class="modal fade">  
                                                    <div class="modal-dialog">  
                                                        <div class="modal-content">  
                                                            <div class="modal-header text-center">  
                                                                <h4 class="modal-title">Kirim Token</h4>  
                                                            </div>  
                                                            <div class="modal-body" id="kirim_token">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div> 

                                                <!-- Modal Kirim Token -->
                                                <!-- <div id="kirim_selesai_modal" class="modal fade">  
                                                    <div class="modal-dialog">  
                                                        <div class="modal-content">  
                                                            <div class="modal-header text-center">  
                                                                <h4 class="modal-title">Kirim Selesai</h4>  
                                                            </div>  
                                                            <div class="modal-body" id="kirim_selesai">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div> 

                                                <!-- Modal Detail Usul Berkala -->
                                                <div id="detail_usul_berkala_modal" class="modal fade">  
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                                        <div class="modal-content"> 
                                                            <div class="modal-header">  
                                                                <h4 class="modal-title">Detail Usul Berkala</h4>  
                                                            </div>  
                                                            <div class="modal-body" id="detail_usul_berkala">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                            <div class="modal-footer">  
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                <i class="far fa-times-circle"></i>
                                                                    Close
                                                                </button>  
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div>

                                                <!-- Modal Edit Usul Berkala -->
                                                <div id="edit_usul_berkala_modal" class="modal fade">  
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">  
                                                                <h4 class="modal-title">Edit Usul Berkala</h4>  
                                                            </div>    
                                                            <div class="modal-body" id="edit_usul_berkala">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div>

                                                <!-- Modal Cetak SK -->
                                                <div id="cetak_sk_modal" class="modal fade">  
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">  
                                                                <h4 class="modal-title">Cetak SK Berkala</h4>  
                                                            </div>    
                                                            <div class="modal-body" id="cetak_sk">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div>

                                                <!-- Modal Hapus Usul Berkala -->
                                                <div id="hapus_usul_berkala_modal" class="modal fade">  
                                                    <div class="modal-dialog">  
                                                        <div class="modal-content">   
                                                            <div class="modal-body" id="hapus_usul_berkala">
                                                            <!-- Modal Body -->
                                                            </div> 
                                                        </div>  
                                                    </div>  
                                                </div>

                                                <!-- Modal Usul Berkala Selesai -->
                                                <div id="usul_berkala_selesai_modal" class="modal fade">  
                                                    <div class="modal-dialog">  
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">  
                                                                <h4 class="modal-title">Arsipkan</h4>  
                                                            </div>   
                                                            <div class="modal-body" id="usul_berkala_selesai">

                                                            </div> 
                                                        </div>  
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

	<!-- Modal input_login -->
    <div id="input_login_modal" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">   
                <div class="modal-body" id="input_login">
                <!-- Modal Body -->
                </div> 
            </div>  
        </div>  
    </div>
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<?php
require 'element/footer.php';
?>