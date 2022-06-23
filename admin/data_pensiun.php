<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT data_pegawai.*, table_pensiun.id, table_pensiun.tmt_terakhir_jabatan, table_pensiun.tanggal_pensiun, table_pensiun.kategori_pensiun, table_pensiun.admin, table_pensiun.pimpinan, spp, fc_sk_cpns_pns, fc_ktp, foto, file_path FROM table_pensiun INNER JOIN data_pegawai ON table_pensiun.nip = data_pegawai.nip ORDER BY table_pensiun.created_at DESC");

// Alert hapus Ajuan
if (isset($_SESSION['pesan'])) {
    echo "<script>".$_SESSION['pesan']."</script>";
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
                                            <li class="breadcrumb-item"><a href="#!">Daftar Pengajuan Pensiun</a></li>
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
                                            <h5>Daftar Pengajuan Pensiun</h5>
                                        </div>
                                        <div class="card-body table-border-style">
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
															<!-- <td><?php echo $row['pimpinan']?></td> -->
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning" href="#"  data-toggle="modal" data-target="#acc_usul_berkala_modal" data-id="<?php echo $row['id'];?>" 
                                                                    data-spp="<?php echo $row['spp'];?>"
                                                                    data-fc_sk_cpns_pns="<?php echo $row['fc_sk_cpns_pns'];?>"
                                                                    data-fc_ktp="<?php echo $row['fc_ktp'];?>"
                                                                    data-foto="<?php echo $row['foto'];?>"
                                                                    data-proses="<?php echo $row['admin'];?>">
                                                                        <i class="far fa-check-circle"></i>
                                                                        Proses
                                                                    </a>

                                                                    <div class="dropdown-divider"></div>

                                                                    <a class="dropdown-item detail_pegawai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                        <i class="fas fa-search"></i>
                                                                        Detail
                                                                    </a>

                                                                    <a class="dropdown-item cetak_sk" href="cetak_sk/cetak_sk_pensiun.php?nip=<?= $row['nip'];?>" target="blank">
                                                                        <i class="fa fa-print"></i>
                                                                        Print
                                                                    </a>

                                                                    <a class="dropdown-item text-danger" href="#"  id="delete" data-id="<?= $row['id'];?>">
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

                                            </div>
                                        </div>
                                    </div>
                                </div>


                             <!-- Modal Usul Berkala -->
                            <div id="acc_usul_berkala_modal" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/update_pensiun.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Data Pensiun</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input id="id" name="id" type="hidden" />
                                            <h3>Kelengkapan Berkas</h3>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="spp">
                                                <label class="form-check-label">Surat Permohonan Pensiun</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="fc_sk_cpns_pns">
                                                <label class="form-check-label">Fotocopy SK CPNS & PNS</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="fc_ktp">
                                                <label class="form-check-label">Fotocopy KTP</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="foto">
                                                <label class="form-check-label">Pas Photo 3x4</label>
                                            </div>
                                            <div class="form-group">
                                                <label>PROSES</label>
                                                <select name="proses" class="form-control">
                                                    <option>PROSES</option>
                                                    <option>APPROVE</option>
                                                    <option>REJECT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-warning">Simpan</button>
                                        </div>
                                    </div>
                                    </form>
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
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
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

    
    
    $('#acc_usul_berkala_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id                  = button.data('id');
        var spp                 = button.data('spp');
        var fc_sk_cpns_pns      = button.data('fc_sk_cpns_pns');
        var fc_ktp              = button.data('fc_ktp');
        var foto                = button.data('foto');
        var proses              = button.data('proses');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=spp]').prop('checked', spp);
        modal.find('.modal-body input[name=fc_sk_cpns_pns]').prop('checked',fc_sk_cpns_pns);
        modal.find('.modal-body input[name=fc_ktp]').prop('checked',fc_ktp);
        modal.find('.modal-body input[name=foto]').prop('checked',foto);
        modal.find('.modal-body select[name=proses]').val(proses);
    });

    

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Hapus data?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'fungsi/delete_pensiun.php',
                    method: "POST",
                    data: "id=" + id,
                    success: function(e) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil dihapus!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500)
                    },
                    error: function(e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menghapus data!',
                            showConfirmButton: false,
                            timer: 1500
                        });                        
                    }
                })
            }
        })
    });
</script>

<?php
require 'element/footer.php';
?>