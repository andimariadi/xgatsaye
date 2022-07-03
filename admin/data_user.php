<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT * FROM verifikator_berkala ORDER BY level");

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
                                            <li class="breadcrumb-item"><a href="#!">Daftar Akun Pengguna</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-md-4">
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_user">
                                    Tambah Pengguna
                                </button>
                            </div>
                        </div>
                        <div class="row">
                                                   
                                <!-- [ post-table ] start -->
                                
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Daftar Akun Pengguna</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >Username</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >SKPD</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Email</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Level</th>
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
															<td><?php echo $row['username']?></td>
															<td><?php echo $row['nama']?></td>
															<td><?php echo $row['skpd']?></td>
															<td><?php echo $row['email']?></td>
															<td><?php echo $row['level']?></td>
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning" href="#"  data-toggle="modal" data-target="#modal_update_user" 
                                                                    data-username="<?php echo $row['username'];?>" 
                                                                    data-nama="<?php echo $row['nama'];?>"
                                                                    data-skpd="<?php echo $row['skpd'];?>"
                                                                    data-email="<?php echo $row['email'];?>"
                                                                    data-level="<?php echo $row['level'];?>"
                                                                    >
                                                                        <i class="far fa-edit"></i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="dropdown-item text-danger" href="#"  id="delete" data-username="<?= $row['username'];?>">
                                                                        <i class="fas fa-trash"></i>
                                                                        Hapus
                                                                    </a> 
                                                                    <a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#modal_reset_password" data-username="<?= $row['username'];?>">
                                                                        <i class="fas fa-key"></i>
                                                                        Reset kata sandi
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


                            <!-- Modal tambah user -->
                            <div id="modal_add_user" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/add_user.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Tambah Pengguna</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Masukkan Username.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>SKPD</label>
                                                <input type="text" class="form-control" name="skpd" placeholder="Masukkan SKPD.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" placeholder="Masukkan Email.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select name="level" class="form-control" required>
                                                    <option value="admin">Admin</option>
                                                    <option value="skpd">SKPD</option>
                                                    <option value="pimpinan">Pimpinan</option>
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

                            <!-- Modal update pengguna -->
                            <div id="modal_update_user" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/update_user.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Update Pengguna</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input name="username" type="hidden">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control input_username" placeholder="Masukkan Username.." disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>SKPD</label>
                                                <input type="text" class="form-control" name="skpd" placeholder="Masukkan SKPD.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" placeholder="Masukkan Email.." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select name="level" class="form-control" required>
                                                    <option value="admin">Admin</option>
                                                    <option value="skpd">SKPD</option>
                                                    <option value="pimpinan">Pimpinan</option>
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

                            <!-- Modal update reset_password -->
                            <div id="modal_reset_password" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/update_user_password.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Atur ulang kata sandi</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input name="username" type="hidden">
                                            <div class="form-group">
                                                <label>Password Baru</label>
                                                <input type="password" class="form-control" name="password" placeholder="Masukkan password baru..">
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

    
    
    $('#modal_update_user').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var username            = button.data('username');
        var nama                = button.data('nama');
        var skpd                = button.data('skpd');
        var email               = button.data('email');
        var level               = button.data('level');
        var modal = $(this);
        modal.find('.modal-body input[name=username], .input_username').val(username);
        modal.find('.modal-body input[name=nama]').val(nama);
        modal.find('.modal-body input[name=skpd]').val(skpd);
        modal.find('.modal-body input[name=email]').val(email);
        modal.find('.modal-body select[name=level]').val(level);
    });
    
    $('#modal_reset_password').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var username            = button.data('username');
        var modal = $(this);
        modal.find('.modal-body input[name=username]').val(username);
    });

    

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var username = $(this).data('username');
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
                    url: 'fungsi/delete_user.php',
                    method: "POST",
                    data: "username=" + username,
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