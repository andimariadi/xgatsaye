<?php
require 'element/header.php';

// Hide Table
$table = '0';

// Percabangan Query
$unit_kerja_induk = '.: Unit Kerja Induk :.';
if (isset($_POST['unit_kerja_induk'])) {
    $unit_kerja_induk = $_POST['unit_kerja_induk'];

    if ($unit_kerja_induk == 'Semua') {
        $query = "SELECT nip, nama, tmt_gol_akhir, unit_kerja, unit_kerja_induk FROM data_pegawai ORDER BY nip DESC";
        $result = mysqli_query($con, $query);
        $table = '1';
    } else {
        $query = "SELECT nip, nama, tmt_gol_akhir, unit_kerja, unit_kerja_induk FROM data_pegawai WHERE unit_kerja_induk = '$unit_kerja_induk' ORDER BY nip DESC";
        $result = mysqli_query($con, $query);
        $table = '1';
    }
} elseif (isset($_POST['nip_nama'])) {
    $nip_nama = $_POST['nip_nama'];
    // Query
    $result = mysqli_query($con, "SELECT nip, nama, tmt_gol_akhir, unit_kerja, unit_kerja_induk FROM data_pegawai WHERE nip LIKE '$nip_nama' OR nama LIKE '%$nip_nama%'");
    // Tampilkan Table
    $table = '1';
} elseif (isset($_SESSION['nip']) && $_SESSION['nip'] != '') {
    $nip = $_SESSION['nip'];
    // Query
    $result = mysqli_query($con, "SELECT nip, nama, tmt_gol_akhir, unit_kerja, unit_kerja_induk FROM data_pegawai WHERE nip = '$nip'");
    $_SESSION['nip'] = '';
    // Tampilkan Table
    $table = '1';
};


// Alert Simpan Pegawai
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
    echo '<script>swal("Success", "Pegawai berhasil disimpan!", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '2') {
    echo '<script>swal("Error", "Pegawai Gagal Ditambahkan!", "error");</script>';
}

// Alert Edit Pegawai
elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '3') {
    echo '<script>swal("Success", "Perubahan berhasil disimpan!", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '4') {
    echo '<script>swal("Error", "Perubahan gagal disimpan!", "error");</script>';
}

// Alert Hapus Pegawai
elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '5') {
    echo '<script>swal("Success", "Pegawai berhasil dihapus!", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '6') {
    echo '<script>swal("Error", "Pegawai gagal dihapus, coba lagi !", "error");</script>';
}

// Alert Hapus Pegawai
elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '7') {
    echo '<script>swal("Success", "Usul Berkala diproses", "success");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '8') {
    echo '<script>swal("Error", "Usul Berkala gagal, coba lagi !", "error");</script>';
} elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '9') {
    echo '<script>swal("Error", "Usul Berkala sudah ada !", "error");</script>';
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

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <i class="fas fa-table mr-1"></i>
                                            Cari Pegawai
                                        </div>
                                        <div class="card-body" style="min-height: 160px;">
                                            <div class="row">
                                                <div class="col-md-12">
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
                                                            
                                                        
                                                            <!-- <button type="button submit" value="OK" class="btn btn-success" style="min-width: 90px">
                                                                <i class="fas fa-search"></i>
                                                                Cari
                                                            </button> -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <i class="fas fa-table mr-1"></i>
                                            <h5>Tampil Pegawai (Berdasarkan Unit Kerja)</h5>
                                        </div>
                                        <div class="card-body table-border-style" style="min-height: 130px;">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <form method="POST">
                                                        <div class="form-group">
                                                            <!-- <label for="unit_kerja_induk">Unit Kerja Induk</label> -->
                                                            <select class="custom-select" id="unit_kerja_induk" type="text" name="unit_kerja_induk" onchange="this.form.submit();">
                                                                <option value="<?= $unit_kerja_induk ?>"><?= $unit_kerja_induk ?></option>
                                                                <?php
                                                                $kategori_query = mysqli_query($con, "SELECT DISTINCT unit_kerja_induk FROM data_pegawai ORDER BY unit_kerja_induk ASC");
                                                                while ($value = mysqli_fetch_array($kategori_query)) {
                                                                ?>
                                                                    <option value="<?= $value['unit_kerja_induk'] ?>"><?= $value['unit_kerja_induk'] ?></option>
                                                                <?php }; ?>
                                                                <option value="Semua">Semua</option>
                                                            </select>
                                                            <small id="unit_kerja_induk" class="form-text text-muted">Menampilkan data pegawai berdasarkan Unit Kerja.</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-outline-warning btn-sm input_pegawai" data-toggle="modal" data-target="#input_pegawai">
                                                                <i class="fas fa-user-plus"></i>
                                                                Input Pegawai
                                                            </button>
                                                           
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
                                            <h5>Data Pegawai</h5>
                                        </div>
                                        <div class="card-body table-border-style">

                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">													
                                                            <th class="align-middle" style="background-color: #cecece; width: 15%" >Nama</th>
                                                            <th class="align-middle" style="background-color: #cecece; width: 8%" >NIP</th>															                 
                                                                       
                                                            <!--<th class="align-middle" style="background-color: #cecece; Max-width: 5px" >Unit Bidang</th>-->
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
                                                                                                           
                                                                <!--<td class="text-left"><?php echo $row['unit_kerja']?></td>-->
                                                                <td class="text-left"><?php echo $row['unit_kerja_induk']?></td>
                                                                <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item text-warning usul_berkala" href="#" name="view" value="View" data-nip="<?php echo $row['nip'];?>">
                                                                            <i class="far fa-check-circle"></i>
                                                                            Usul Berkala
                                                                        </a>

                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item edit_pegawai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fas fa-user-edit"></i>
                                                                            Edit
                                                                        </a>

                                                                        <a class="dropdown-item detail_pegawai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fas fa-search"></i>
                                                                            Detail
                                                                        </a>

                                                                        <a class="dropdown-item riwayat_usul_pangkat" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fas fa-archive"></i>
                                                                            Riwayat Usul Berkala
                                                                        </a>

                                                                        <a class="dropdown-item hapus_pegawai text-danger" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                            <i class="fas fa-user-times"></i>
                                                                            Hapus
                                                                        </a> 
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>                                                     
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
                                                        $('.usul_berkala').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/usul_berkala.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#usul_berkala").html(data)
                                                                    $("#usul_berkala_modal").modal('show')
                                                                }
                                                            })
                                                        })
                                                    });

                                                    // Script Edit Pegawai
                                                    $(document).ready(function(){
                                                        $('.edit_pegawai').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/edit_pegawai.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#edit_pegawai").html(data)
                                                                    $("#edit_pegawai_modal").modal('show')
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

                                                    // Script Hapus Pegawai
                                                    $(document).ready(function(){
                                                        $('.hapus_pegawai').click(function(){
                                                            var nip = $(this).data("nip")
                                                            $.ajax({
                                                                url: "modal/hapus_pegawai.php",
                                                                method: "POST",
                                                                data: {nip: nip},
                                                                success: function(data){
                                                                    $("#hapus_pegawai").html(data)
                                                                    $("#hapus_pegawai_modal").modal('show')
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
                            <?php } ?>

                                  <!-- Modal Usul Berkala -->
                                <div id="usul_berkala_modal" class="modal fade">  
                                    <div class="modal-dialog">  
                                        <div class="modal-content">   
                                            <div class="modal-body" id="usul_berkala">
                                            <!-- Modal Body -->
                                            </div> 
                                        </div>  
                                    </div>  
                                </div>

                                <!-- Modal Edit Pegawai -->
                                <div id="edit_pegawai_modal" class="modal fade">  
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                        <div class="modal-content">
                                            <div class="modal-header text-center">  
                                                <h4 class="modal-title">EDIT PEGAWAI</h4>  
                                            </div>   
                                            <div class="modal-body" id="edit_pegawai">
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

                                <!-- Modal Hapus Pegawai -->
                                <div id="hapus_pegawai_modal" class="modal fade">  
                                    <div class="modal-dialog">  
                                        <div class="modal-content">  
                                            <div class="modal-body" id="hapus_pegawai">
                                            <!-- Modal Body -->
                                            </div> 
                                        </div>  
                                    </div>  
                                </div>

                                <!-- Modal Riwayat Usul Berkala -->
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

                                <!-- Modal Input Pegawai -->
                                <div id="input_pegawai" class="modal fade">  
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">  
                                        <div class="modal-content">  
                                            <div class="modal-header text-center">  
                                                <h4 class="modal-title">INPUT PEGAWAI</h4>  
                                            </div>  
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form method="post" action="fungsi/simpan_pegawai.php" class="text-center pt-1">

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">NIP</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="nip" required>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">Nama & Gelar</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="gelar_depan" placeholder="Gelar Depan">
                                                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                                                <input type="text" class="form-control" name="gelar_belakang" placeholder="Gelar Belakang">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">TTL</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                                                                <input type="date" class="form-control" name="tanggal_lahir">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="btn btn-secondary text-left" for="gol_awal_cpns" style="width: 220px">Gol. Awal CPNS</label>
                                                                </div>
                                                                <select class="custom-select" id="gol_awal_cpns" name="gol_awal_cpns">
                                                                    <option value="">.: Golongan Awal CPNS :.</option>
                                                                    <option value="I/a">I/a</option>
                                                                    <option value="I/b">I/b</option>
                                                                    <option value="I/c">I/c</option>
                                                                    <option value="I/d">I/d</option>
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
                                                                    <option value="IV/e">IV/e</option>
                                                                </select>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">TMT CPNS</span>
                                                                </div>
                                                                <input type="date" class="form-control" name="tmt_cpns">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">TMT PNS</span>
                                                                </div>
                                                                <input type="date" class="form-control" name="tmt_pns">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="btn btn-secondary text-left" for="jenis_kelamin" style="width: 220px">Jenis Kelamin</label>
                                                                </div>
                                                                <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                                                    <option value="">.: Jenis Kelamin :.</option>
                                                                    <option value="L">Laki-Laki</option>
                                                                    <option value="P">Perempuan</option>
                                                                </select>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="btn btn-secondary text-left" for="gol_akhir" style="width: 220px">Gol. Akhir</label>
                                                                </div>
                                                                <select class="custom-select" id="gol_akhir" name="gol_akhir">
                                                                    <option value="">.: Golongan :.</option>
                                                                    <option value="I/a">I/a</option>
                                                                    <option value="I/b">I/b</option>
                                                                    <option value="I/c">I/c</option>
                                                                    <option value="I/d">I/d</option>
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
                                                                    <option value="IV/e">IV/e</option>
                                                                </select>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">TMT Gol. Akhir</span>
                                                                </div>
                                                                <input type="date" class="form-control" name="tmt_gol_akhir">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="btn btn-secondary text-left" style="width: 220px">Masa Kerja</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="thn_masa_kerja" placeholder="Tahun">
                                                                <input type="text" class="form-control" name="bln_masa_kerja" placeholder="Bulan">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">Jabatan Struktural</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="nama_jabatan_struktural">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">TMT Jabatan Struktural</button>
                                                                </div>
                                                                <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="tmt_jabatan_struktural">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">Jabatan Fungsional Tertentu</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="nama_jabatan_fungsional_tertentu">
                                                                <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="tmt_jabatan_fungsional_tertentu">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">Jabatan Fungsional Umum</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="nama_jabatan_fungsional_umum">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">Unit Kerja</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="unit_kerja">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">Unit Kerja Induk</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="unit_kerja_induk">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-secondary text-left" style="width: 220px" type="button">No HP</button>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" name="no_hp">
                                                            </div>

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          
                                                            <button type="button submit" value="OK" class="btn btn-warning">Simpan</button>

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

<?php
require 'element/footer.php';
?>