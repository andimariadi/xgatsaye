<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT * FROM table_gajih ORDER BY id");

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
                                            <li class="breadcrumb-item"><a href="#!">Daftar Gaji</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-md-4">
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_gaji">
                                    Tambah Gaji
                                </button>
                            </div>
                        </div>
                        <div class="row">
                                                   
                                <!-- [ post-table ] start -->
                                
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Daftar Gaji</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >Pangkat</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Masa Jabatan</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Golongan</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Gaji Pokok</th>
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
															<td><?php echo strtoupper( $row['pangkat'] )?></td>
															<td><?php echo $row['masa_jabatan']?></td>
															<td><?php echo $row['golongan']?></td>
															<td><?php echo $row['gaji_pokok']?></td>
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning" href="#"  data-toggle="modal" data-target="#modal_update_gaji" 
                                                                    data-id="<?php echo $row['id'];?>" 
                                                                    data-pangkat="<?php echo $row['pangkat'];?>"
                                                                    data-masa_jabatan="<?php echo $row['masa_jabatan'];?>"
                                                                    data-golongan="<?php echo $row['golongan'];?>"
                                                                    data-gaji_pokok="<?php echo $row['gaji_pokok'];?>"
                                                                    >
                                                                        <i class="far fa-edit"></i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="dropdown-item text-danger" href="#"  id="delete" data-id="<?= $row['id'];?>">
                                                                        <i class="fas fa-trash"></i>
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


                            <!-- Modal tambah gaji -->
                            <div id="modal_add_gaji" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/add_gaji.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Tambah Gaji</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Pangkat</label>
                                                <input type="text" class="form-control" name="pangkat" placeholder="Masukkan pangkat..">
                                            </div>
                                            <div class="form-group">
                                                <label>Masa Jabatan</label>
                                                <input type="text" class="form-control" name="masa_jabatan" placeholder="Masukkan masa jabatan..">
                                            </div>
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <input type="text" class="form-control" name="golongan" placeholder="Masukkan golongan..">
                                            </div>
                                            <div class="form-group">
                                                <label>Gaji Pokok</label>
                                                <input type="text" class="form-control" name="gaji_pokok" placeholder="Masukkan gaji pokok..">
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

                            <!-- Modal update gaji -->
                            <div id="modal_update_gaji" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/update_gaji.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Update Gaji</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input name="id" type="hidden">
                                            <div class="form-group">
                                                <label>Pangkat</label>
                                                <input type="text" class="form-control" name="pangkat" placeholder="Masukkan pangkat..">
                                            </div>
                                            <div class="form-group">
                                                <label>Masa Jabatan</label>
                                                <input type="text" class="form-control" name="masa_jabatan" placeholder="Masukkan masa jabatan..">
                                            </div>
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <input type="text" class="form-control" name="golongan" placeholder="Masukkan golongan..">
                                            </div>
                                            <div class="form-group">
                                                <label>Gaji Pokok</label>
                                                <input type="text" class="form-control" name="gaji_pokok" placeholder="Masukkan gaji pokok..">
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

    
    
    $('#modal_update_gaji').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id                  = button.data('id');
        var pangkat             = button.data('pangkat');
        var masa_jabatan        = button.data('masa_jabatan');
        var golongan            = button.data('golongan');
        var gaji_pokok          = button.data('gaji_pokok');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=pangkat]').val(pangkat);
        modal.find('.modal-body input[name=masa_jabatan]').val(masa_jabatan);
        modal.find('.modal-body input[name=golongan]').val(golongan);
        modal.find('.modal-body input[name=gaji_pokok]').val(gaji_pokok);
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
                    url: 'fungsi/delete_gaji.php',
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