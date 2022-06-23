<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala INNER JOIN data_pegawai ON ajuan_usul_berkala.nip = data_pegawai.nip ORDER BY ajuan_usul_berkala.nip DESC");

// Alert hapus Ajuan
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
    echo '<script>swal("Success", "Ajuan berhasil dihapus !", "success");</script>';
}
elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '2') {
    echo '<script>swal("Error", "Ajuan gagal dihapus !", "error");</script>';
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
                                            <h5 class="m-b-10"></h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item" ><a href="#!">Menu</a></li>
                                            <li class="breadcrumb-item"><a href="#!">Daftar Ajuan Berkala</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                   
                                <!-- [ post-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Daftar Usulan Berkala</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 4%" >Tanggal</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>

															<th class="align-middle" style="background-color: #cecece; width: 18%" >Unit Kerja Induk</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Keterangan</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 5%" >Action</th>
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
															<td><?php echo $row['nip']?></td>
															<td><?php echo $row['nama']?></td>
														
															<td><?php echo $row['unit_kerja_induk']?></td>
															<td><?php echo $row['keterangan']?></td>
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning acc_usul_berkala" href="#" name="view" value="View" data-nip="<?php echo $row['nip'];?>">
                                                                        <i class="far fa-check-circle"></i>
                                                                        Usul Berkala
                                                                    </a>

                                                                    <div class="dropdown-divider"></div>

                                                                    <a class="dropdown-item detail_pegawai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                        <i class="fas fa-search"></i>
                                                                        Detail
                                                                    </a>

                                                                    <a class="dropdown-item riwayat_usul_pangkat" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                        <i class="fas fa-archive"></i>
                                                                        Riwayat Usul Berkala
                                                                    </a>

                                                                    <a class="dropdown-item hapus_ajuan text-danger" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                        <i class="fas fa-user-times"></i>
                                                                        Hapus
                                                                    </a> 
                                                                    </div>
                                                                </div>
                                                            </td>
														</tr>
                                                        <?php $no++; } ?>                                                     
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#example').DataTable();
                                                    });
                                                </script>

                                                <script type="text/javascript">
                                                    // Script Modal Usul Berkala
                                                    $(document).ready(function(){
                                                        $('.acc_usul_berkala').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/acc_usul_berkala.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#acc_usul_berkala").html(data)
                                                                    $("#acc_usul_berkala_modal").modal('show')
                                                                }
                                                            })
                                                        })
                                                    });

                                                    // Script Detail Pegawai
                                                    $(document).ready(function(){
                                                        $('.detail_pegawai').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/detail_pegawai.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#detail_pegawai").html(data)
                                                                    $("#detail_pegawai_modal").modal('show')
                                                                }
                                                            })
                                                        })
                                                    });

                                                    // Script Hapus Ajuan
                                                    $(document).ready(function(){
                                                        $('.hapus_ajuan').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/hapus_ajuan.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#hapus_ajuan").html(data)
                                                                    $("#hapus_ajuan_modal").modal('show')
                                                                }
                                                            })
                                                        })
                                                    });

                                                    // Script Riwayat Usul Berkala
                                                    $(document).ready(function(){
                                                        $('.riwayat_usul_pangkat').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/list_riwayat.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#list_riwayat").html(data)
                                                                    $("#list_riwayat_modal").modal('show')
                                                                }
                                                            })
                                                        })
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                             <!-- Modal Usul Berkala -->
                            <div id="acc_usul_berkala_modal" class="modal fade">  
                                <div class="modal-dialog">  
                                    <div class="modal-content">   
                                        <div class="modal-body" id="acc_usul_berkala">
                                        <!-- Modal Body -->
                                        </div> 
                                    </div>  
                                </div>  
                            </div>

                            <!-- Modal Detail Pegawai -->
                            <div id="detail_pegawai_modal" class="modal fade">  
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                    <div class="modal-content">
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Detail Pegawai</h4>  
                                        </div>  
                                        <div class="modal-body" id="detail_pegawai">
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

                            <!-- Modal Hapus ajuan -->
                            <div id="hapus_ajuan_modal" class="modal fade">  
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-body" id="hapus_ajuan">
                                        <!-- Modal Body -->
                                        </div> 
                                    </div>  
                                </div>  
                            </div>

                            <!-- Modal Detail Pegawai -->
                            <div id="list_riwayat_modal" class="modal fade">  
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                    <div class="modal-content">
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Riwayat Usul Berkala</h4>  
                                        </div>  
                                        <div class="modal-body" id="list_riwayat">
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
                          
                        </div>
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