<?php
require 'element/header.php';
$query = mysqli_query($con,"SELECT data_pegawai.*, table_pangkat.id, table_pangkat.golongan_pangkat_tujuan, table_pangkat.file_path FROM table_pangkat INNER JOIN data_pegawai ON table_pangkat.nip = data_pegawai.nip WHERE data_pegawai.unit_kerja_induk = '$skpd' ORDER BY created_at DESC");

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
                                            <h5 class="m-b-10">Home</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">dashboard</a></li>
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
                                            <h5>Daftar Usulan Pangkat</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
															<th class="align-middle" style="background-color: #cecece; width: 1%" >Gol/Pangkat</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Unit Kerja Induk</th>
															<th class="align-middle" style="background-color: #cecece; width: 4%" >Golongan Pangkat Tujuan</th>
															<th class="align-middle" style="background-color: #cecece; width: 4%" >Document</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Action</th>
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
															<td><?php echo $row['gol_akhir']?></td>
															<td><?php echo $row['unit_kerja_induk']?></td>
															<td><?php echo $row['golongan_pangkat_tujuan']?></td>
															<td><a href="<?=$row['file_path']?>">Lihat document</a></td>
															<td><div class="dropdown">
                                                                <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-secondary usul_berkala" href="#" data-toggle="modal" data-target="#edit_modal" data-id="<?= $row['id'];?>" data-golongan_pangkat_tujuan="<?= $row['golongan_pangkat_tujuan'];?>"
                                                                    data-file_path="<?= $row['file_path'];?>">
                                                                        <i class="fas fa-edit"></i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="dropdown-item text-secondary" id="delete" data-id="<?= $row['id'];?>">
                                                                        <i class="fas fa-trash"></i>
                                                                        Hapus
                                                                    </a>

                                                                </div>
                                                            </div></td>
														</tr>
                                                        <?php $no++; } ?>                                                     
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#example').DataTable();
                                                    });
                                                </script>
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



<!-- Modal Usul Pensiun -->
<div id="edit_modal" class="modal fade">  
    <div class="modal-dialog">
        <form method="POST"  enctype="multipart/form-data" action="fungsi/update_pangkat.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengajuan Pangkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>   
            <div class="modal-body">
                <input id="id" name="id" type="hidden" />
                <div class="form-group">
                    <label>Golongan Pangkat Tujuan</label>
                    <input type="text" name="golongan_pangkat_tujuan" placeholder="Golongan Pangkat Tujuan" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Dokumen Persyaratan</label>
                    <input type="file" name="document" placeholder="Dokumen Persyaratan" class="form-control" />
                    <span class="text-muted">Upload file akan menimpa file sebelumnya.</span>
                </div>
                
                <a href="#" id="file_path">Lihat dokument terupload</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
        </div>
        </form>
    </div>  
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
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
                    url: 'fungsi/delete_pangkat.php',
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

    $('#edit_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id                       = button.data('id');
        var golongan_pangkat_tujuan     = button.data('golongan_pangkat_tujuan');
        var file_path     = button.data('file_path');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=golongan_pangkat_tujuan]').val(golongan_pangkat_tujuan);
        modal.find('.modal-body #file_path').attr('href', file_path);
    });
</script>

<?php
require 'element/footer.php';
?>