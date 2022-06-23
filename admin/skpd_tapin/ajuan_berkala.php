<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala 
INNER JOIN data_pegawai ON ajuan_usul_berkala.nip = data_pegawai.nip 
LEFT JOIN berkas_ajuan_usul_berkala ON berkas_ajuan_usul_berkala.nip = ajuan_usul_berkala.nip
WHERE data_pegawai.unit_kerja_induk = '$skpd' ORDER BY ajuan_usul_berkala.nip DESC");

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
															<th class="align-middle" style="background-color: #cecece; width: 1%" >Gol/Pangkat</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Unit Kerja Induk</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 18%" >Document</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Keterangan</th>
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
															<td><?php echo $row['tanggal']?></td>
															<td><?php echo $row['nip']?></td>
															<td><?php echo $row['nama']?></td>
															<td><?php echo $row['gol_akhir']?></td>
															<td><?php echo $row['unit_kerja_induk']?></td>
															<td><a href="<?=$row['file_path']?>">Lihat document</a></td>
															<td><?php echo $row['keterangan']?></td>
                                                            <td><div class="dropdown">
                                                                <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-secondary usul_berkala" href="#" data-toggle="modal" data-target="#edit_modal" data-nip="<?= $row['nip'];?>" data-no_hp="<?= $row['no_hp'];?>"
                                                                    data-file_path="<?= $row['file_path'];?>">
                                                                        <i class="fas fa-edit"></i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="dropdown-item text-secondary" id="delete" data-nip="<?= $row['nip'];?>">
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
        <form method="POST"  enctype="multipart/form-data" action="fungsi/update_ajuan_berkala.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Usul Berkala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>   
            <div class="modal-body">
                <input type="hidden" value="" name="no_hp_lama">
                <input type="hidden" value="" name="nip">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 220px">No HP</span>
                    </div>
                    <input type="number" class="form-control bg-white" name="no_hp_baru" value="<?= $no_hp ?>" required>
                </div>

                <div class="form-group">
                    <label>Dokumen Persyaratan</label>
                    <input type="file" name="document" placeholder="Dokumen Persyaratan" class="form-control" />
                    <p class="help-block">Gabungkan file yang akan diupload</p>
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
        var nip = $(this).data('nip');
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
                    url: 'fungsi/delete_ajuan_berkala.php',
                    method: "POST",
                    data: "nip=" + nip,
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
        var nip             = button.data('nip');
        var no_hp           = button.data('no_hp');
        var file_path           = button.data('file_path');
        var modal = $(this);
        modal.find('.modal-body input[name=nip]').val(nip);
        modal.find('.modal-body input[name=no_hp_lama], .modal-body input[name=no_hp_baru]').val(no_hp);
        modal.find('.modal-body #file_path').attr('href', file_path);
    });
</script>

<?php
require 'element/footer.php';
?>