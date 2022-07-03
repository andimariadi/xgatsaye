<?php
require 'element/header.php';

// Hide Table
$table = '0';

// Percabangan Query
if (isset($_POST['nip_nama'])) {
    $nip_nama = $_POST['nip_nama'];
    // Query
    $result = mysqli_query($con, "SELECT * FROM data_pegawai WHERE unit_kerja_induk = '$skpd' AND nip LIKE '$nip_nama' OR nama LIKE '%$nip_nama%' AND unit_kerja_induk = '$skpd'");
    // Tampilkan Table
    $table = '1';
} elseif (isset($_POST['tampil_semua'])) {
    // Query
    $result = mysqli_query($con, "SELECT * FROM data_pegawai WHERE unit_kerja_induk = '$skpd'");
    // Tampilkan Table
    $table = '1';
};

// Alert Usul Ajuan
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Pegawai Berhasil diajukan!',
        showConfirmButton: false,
        timer: 1500
      });</script>";
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '2') {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Pegawai Gagal Diajukan!',
        showConfirmButton: false,
        timer: 1500
      });</script>
    ";
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '9') {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Pegawai sudah pernah diajukan!',
        showConfirmButton: false,
        timer: 1500
      });</script>
    ";
}

if (isset($_SESSION['msg'])) {
    echo "<script>".$_SESSION['msg']."</script>";
}

$_SESSION['pesan'] = '';
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
                                                    <!-- <h5 class="m-b-10">Database</h5> -->
                                                </div>
                                                <ul class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                                                    <li class="breadcrumb-item" ><a href="#!">Data Pegawai</a></li>
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
                                            Cari Pegawai
                                        </div>

                                        <div class="card-body" style="min-height: 160px;">
                                            <div class="row">
                                                <div class="col-md-3">

                                                    <form method="POST">
                                                        <div class="form-group">
                                                            <input id="nip_nama" type="text" class="form-control" name="nip_nama" placeholder=".: Masukkan NIP atau Nama :." required>
                                                            <small id="nama_nip" class="form-text text-muted">Menampilkan data pegawai berdasarkan inputan NIP / Nama</small>
                                                        </div>
                                                    
                                                        <div class="form-group"> 
                                                            <button type="button submit" value="OK" class="btn btn-outline-warning btn-sm">
                                                                <i class="fas fa-search"></i>
                                                                Cari Pegawai
                                                            </button> 
                                                        </div>  
                                                    </form>
                                                    
                                                </div>

                                                <div class="col-md-6">
                                                    <form method="POST">                                                       
                                                            <input class="btn btn-warning" type="submit" name="tampil_semua" value="Tampil Semua">                                                             
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
                                            <h5>Data Pegawai</h5>
                                        </div>
                                        <div class="card-body table-border-style">

                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">													
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>															                                                                          
                                                            <th class="align-middle" style="background-color: #cecece; width: 10%" >Unit Kerja</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 21%" >Unit Kerja Induk</th>															
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
                                                                <td class="text-left"><?php echo $row['unit_kerja']?></td>
                                                                <td class="text-left"><?php echo $row['unit_kerja_induk']?></td>
                                                                <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item text-secondary usul_berkala" href="#" data-toggle="modal" data-target="#usul_berkala_modal" data-nip="<?= $row['nip'];?>" data-no_hp="<?= $row['no_hp'];?>">
                                                                            <i class="far fa-check-circle"></i>
                                                                            Usul Berkala
                                                                        </a>
                                                                        <a class="dropdown-item text-secondary" data-toggle="modal" data-target="#usul_pensiun_modal" data-nip="<?= $row['nip'];?>">
                                                                            <i class="far fa-check-circle"></i>
                                                                            Usul Pensiun
                                                                        </a>
                                                                        <a class="dropdown-item text-secondary" data-toggle="modal" data-target="#pangkat_modal" data-nip="<?= $row['nip'];?>">
                                                                            <i class="far fa-check-circle"></i>
                                                                            Kenaikan Pangkat
                                                                        </a>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                           </div>
                            <!-- [ Main Content ] end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Modal Usul Berkala -->
<div id="usul_berkala_modal" class="modal fade">  
    <div class="modal-dialog">
    <form method="post" action="fungsi/usul_berkala.php" enctype="multipart/form-data">
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
                
                <h3>Dokumen Persyaratan</h3>
                <hr/>
                <div class="form-group">
                    <label>Form Usul Berkala</label>
                    <input type="file" name="document_form" placeholder="Form Usul Berkala" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>SK Berkala Terakhir</label>
                    <input type="file" name="document_sk_berkala" placeholder="SK Berkala Terakhir" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>SK Pangkat Terakhir</label>
                    <input type="file" name="document_sk_pangkat" placeholder="SK Pangkat Terakhir" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>SK Pemangku Jabatan</label>
                    <input type="file" name="document_sk_jabatan" placeholder="SK Pemangku Jabatan" class="form-control" />
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

<!-- Modal Usul Pensiun -->
<div id="usul_pensiun_modal" class="modal fade">  
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" action="fungsi/pensiun.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengajuan Pensiun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input id="nip" name="nip" type="hidden" />
                <div class="form-group">
                    <label>TMT Berakhir Jabatan</label>
                    <input type="date" name="tmt_terakhir_jabatan" placeholder="TMT Berakhir Jabatan" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Tanggal Pensiun</label>
                    <input type="date" name="tanggal_pensiun" placeholder="Tanggal Pensiun" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Kategori Pensiun</label>
                    <select class="form-control" name="kategori_pensiun">
                        <option>BUP</option>
                        <option>Pensiun Dini</option>
                        <option>Janda</option>
                        <option>Duda</option>
                    </select>
                </div>
                <h3>Dokumen Persyaratan</h3>
                <hr/>
                <div class="form-group">
                    <label>Surat Permohonan Pensiun</label>
                    <input type="file" name="document_spp" placeholder="Surat Permohonan Pensiun" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Fotocopy SK CPNS & PNS</label>
                    <input type="file" name="document_fc_sk_cpns_pns" placeholder="Fotocopy SK CPNS & PNS" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Fotocopy KTP</label>
                    <input type="file" name="document_fc_ktp" placeholder="Fotocopy KTP" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Pas Photo 3x4</label>
                    <input type="file" name="document_foto" placeholder="Pas Photo 3x4" class="form-control" />
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

<!-- Modal Usul Pensiun -->
<div id="pangkat_modal" class="modal fade">  
    <div class="modal-dialog">
        <form method="POST"  enctype="multipart/form-data" action="fungsi/pangkat.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengajuan Pangkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>   
            <div class="modal-body">
                <input id="nip" name="nip" type="hidden" />
                <div class="form-group">
                    <label>Golongan Pangkat Tujuan</label>
                    <select class="form-control" name="golongan_pangkat_tujuan" placeholder="Golongan Pangkat Tujuan">
                        <option value="I/a">I/a</option>
                        <option value="I/b">I/b</option>
                        <option value="I/c">I/c</option>
                        <option value="II/d">I/d</option>
                        <option value="II/a">II/a</option>
                        <option value="II/b">II/b</option>
                        <option value="II/c">II/c</option>
                        <option value="II/d">II/d</option>
                        <option value="III/a">III/a</option>
                        <option value="III/b">III/b</option>
                        <option value="III/c">III/c</option>
                        <option value="III/d">III/d</option>
                        <option value="IV/a">IV/a</option>
                        <option value="IV/b">IV/b</option>
                        <option value="IV/c">IV/c</option>
                        <option value="IV/d">IV/d</option>
                    </select>
                </div>
                
                <h3>Dokumen Persyaratan</h3>
                <hr/>
                <div class="form-group">
                    <label>SK Kenaikan Pangkat Terakhir</label>
                    <input type="file" name="document_sk_kenaikan_pangkat_terakhir" placeholder="SK Kenaikan Pangkat Terakhir" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Fotocopy SK CPNS & PNS</label>
                    <input type="file" name="document_fc_sk_cpns_pns" placeholder="Fotocopy SK CPNS & PNS" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Fotocopy SKP</label>
                    <input type="file" name="document_fc_skp" placeholder="Fotocopy SKP" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Fotocopy Kartu Pegawai</label>
                    <input type="file" name="document_fc_kp" placeholder="Fotocopy Kartu Pegawai" class="form-control" />
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    
    $('#usul_pensiun_modal, #pangkat_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var nip             = button.data('nip');
        var modal = $(this);
        modal.find('.modal-body #nip').val(nip);
    });
    
    $('#usul_berkala_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var nip             = button.data('nip');
        var no_hp           = button.data('no_hp');
        var modal = $(this);
        modal.find('.modal-body input[name=nip]').val(nip);
        modal.find('.modal-body input[name=no_hp_lama], .modal-body input[name=no_hp_baru]').val(no_hp);
    });
</script>
<?php
require 'element/footer.php';
?>