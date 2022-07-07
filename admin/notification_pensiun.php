<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT data_pegawai.*, verifikator_berkala.email FROM data_pegawai LEFT JOIN verifikator_berkala ON unit_kerja_induk = verifikator_berkala.skpd ORDER BY nama");

// Alert hapus Ajuan
if (isset($_SESSION['msg'])) {
    echo "<script>".$_SESSION['msg']."</script>";
}

$_SESSION['msg'] = '';
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
                                            <li class="breadcrumb-item"><a href="#!">Daftar Pegawai</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="row">
                                                   
                                <!-- [ post-table ] start -->                                
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Daftar Pegawai</h5>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Tempat, Tanggal Lahir</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Golongan Akhir</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >TMT Golongan Akhir</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Unit Kerja</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Unit Kerja Induk</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Email Instansi</th>
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
															<td><?php echo strtoupper( $row['nip'] )?></td>
															<td><?php echo $row['gelar_depan'] . ' ' .$row['nama'] . $row['gelar_belakang']?></td>
															<td><?php echo $row['tempat_lahir'] . ', ' . date('d F Y', strtotime($row['tanggal_lahir']))?></td>
															<td><?php echo strtoupper( $row['gol_akhir'] )?></td>
                                                            <td><?php echo strtoupper( $row['tmt_gol_akhir'] )?></td>
                                                            <td><?php echo strtoupper( $row['unit_kerja'] )?></td>
                                                            <td><?php echo strtoupper( $row['unit_kerja_induk'] )?></td>
                                                            <td><?php echo $row['email']?></td>
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning" href="#"  data-toggle="modal" data-target="#modal_send_message"
                                                                    data-nip="<?= $row['nip'];?>"
                                                                    data-nama="<?= $row['gelar_depan'] . ' ' .$row['nama'] . $row['gelar_belakang'];?>"
                                                                    data-email="<?= $row['email'];?>"
                                                                    data-message=""
                                                                    >
                                                                        <i class="far fa-edit"></i>
                                                                        Send Message
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
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Modal tambah gaji -->
<div id="modal_send_message" class="modal fade">  
    <div class="modal-dialog">
        <form method="POST"  enctype="multipart/form-data" action="fungsi/notification_pensiun.php">
        <div class="modal-content">   
            <div class="modal-header">  
                <h4 class="modal-title">Kirim Notifikasi</h4>  
            </div>  
            <div class="modal-body">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP..">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap..">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email..">
                </div>
                <div class="form-group">
                    <label>Kategori Pensiun</label>
                    <select class="form-control" name="kategori_pensiun" required>
                        <option value="">Pilih</option>
                        <option>BUP</option>
                        <option>Pensiun Dini</option>
                        <option>Janda</option>
                        <option>Duda</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kirim Pesan</label>
                    <textarea name="message" placeholder="Kirim pesan..." class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-warning">Kirim notifikasi</button>
            </div>
        </div>
        </form>
    </div>  
</div>

<script type="text/javascript">
    $('#modal_send_message').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var nip                       = button.data('nip');
        var nama                      = button.data('nama');
        var email                     = button.data('email');
        var modal = $(this);
        modal.find('.modal-body input[name=nip]').val(nip);
        modal.find('.modal-body input[name=nama]').val(nama);
        modal.find('.modal-body input[name=email]').val(email);
        
        modal.find('.modal-body textarea[name=message]').val('Hallo ' + nama + ', kami dari BKSPDM ingin menginformasikan bahwa Anda diusulkan untuk melakuan pensiun, silahkan lengkapi berkas Anda. Dan ajukan menggunakan menu usul berkala di SKPD Anda. Terima kasih');
    });

    $('#example').DataTable();
</script>
<?php
require 'element/footer.php';
?>