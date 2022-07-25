<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT data_pegawai.*, table_pangkat.id, table_pangkat.golongan_pangkat_tujuan, table_pangkat.admin, table_pangkat.pimpinan,  file_path_sk_kenaikan_pangkat_terakhir, file_path_fc_sk_cpns_pns, file_path_fc_skp, file_path_fc_kp, sk_kenaikan_pangkat_terakhir, fc_sk_cpns_pns, fc_skp, fc_kp, masa_kerja_golongan, gaji_pokok, pendidikan, jabatan FROM table_pangkat INNER JOIN data_pegawai ON table_pangkat.nip = data_pegawai.nip ORDER BY table_pangkat.created_at DESC");

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
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Golongan Pangkat Tujuan</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >SK Kenaikan Pangkat Terakhir</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Fotocopy SK CPNS & PNS</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Fotocopy SKP</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Fotocopy Kartu Pegawai</th>
															<th class="align-middle" style="background-color: #cecece; width: 18%" >Document</th>
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
															<td><?php echo $row['golongan_pangkat_tujuan']?></td>
															<td><a href="<?= base_url($row['file_path_sk_kenaikan_pangkat_terakhir']);?>">Lihat SK Kenaikan Pangkat Terakhir</a></td>
															<td><a href="<?= base_url($row['file_path_fc_sk_cpns_pns']);?>">Lihat Fotocopy SK CPNS & PNS</a></td>
															<td><a href="<?= base_url($row['file_path_fc_skp']);?>">Lihat Fotocopy SKP</a></td>
															<td><a href="<?= base_url($row['file_path_fc_kp']);?>">Lihat Fotocopy Kartu Pegawai</a></td>
															<td><?php echo $row['admin']?></td>
                                                            <td class="text-center align-middle">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item text-warning" href="#"  data-toggle="modal" data-target="#acc_usul_berkala_modal" 
                                                                    data-id="<?php echo $row['id'];?>" 
                                                                    data-proses="<?php echo $row['admin'];?>"
                                                                    data-sk_kenaikan_pangkat_terakhir="<?php echo $row['sk_kenaikan_pangkat_terakhir'];?>"
                                                                    data-fc_sk_cpns_pns="<?php echo $row['fc_sk_cpns_pns'];?>"
                                                                    data-fc_skp="<?php echo $row['fc_skp'];?>"
                                                                    data-fc_kp="<?php echo $row['fc_kp'];?>"
                                                                    >
                                                                        <i class="far fa-check-circle"></i>
                                                                        Proses
                                                                    </a>

                                                                    <div class="dropdown-divider"></div>

                                                                    <a class="dropdown-item detail_pegawai" href="#" name="view" value="View" data-nip="<?php echo $row['nip']; ?>">
                                                                        <i class="fas fa-search"></i>
                                                                        Detail
                                                                    </a>

                                                                    <!-- <a class="dropdown-item cetak_sk" href="cetak_sk/cetak_sk_pangkat.php?nip=<?= $row['nip'];?>" target="blank">
                                                                        <i class="fa fa-print"></i>
                                                                        Print
                                                                    </a> -->

                                                                    <a class="dropdown-item cetak_sk" href="#" data-toggle="modal" data-target="#modal_print"
                                                                    data-id="<?php echo $row['id'];?>"
                                                                    data-nama="<?php echo $row['nama'];?>"
                                                                    data-nip="<?php echo $row['nip'];?>"
                                                                    data-tempat_lahir="<?php echo $row['tempat_lahir'];?>"
                                                                    data-tanggal_lahir="<?php echo $row['tanggal_lahir'];?>"
                                                                    data-unit_kerja="<?php echo $row['unit_kerja'];?>"
                                                                    data-instansi_induk="<?php echo $row['unit_kerja_induk'];?>"
                                                                    data-jabatan="<?php echo $row['jabatan'];?>"
                                                                    data-pendidikan="<?php echo $row['pendidikan'];?>"
                                                                    data-masa_kerja_golongan="<?php echo $row['masa_kerja_golongan'];?>"
                                                                    data-gaji_pokok="<?php echo $row['gaji_pokok'];?>"
                                                                    >
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
                                    <form method="POST"  enctype="multipart/form-data" action="fungsi/update_pangkat.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Data Pangkat</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input id="id" name="id" type="hidden" />
                                            
                                            <h3>Kelengkapan Berkas</h3>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="sk_kenaikan_pangkat_terakhir">
                                                <label class="form-check-label">SK Kenaikan Pangkat Terakhir</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="fc_sk_cpns_pns">
                                                <label class="form-check-label">Fotocopy SK CPNS & PNS</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="fc_skp">
                                                <label class="form-check-label">Fotocopy SKP</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="fc_kp">
                                                <label class="form-check-label">Fotocopy Kartu Pegawai</label>
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
                            

                            
                            <!-- Modal Usul Berkala -->
                            <div id="modal_print" class="modal fade">  
                                <div class="modal-dialog">
                                    <form method="POST"  enctype="multipart/form-data" action="cetak_sk/cetak_sk_pangkat.php">
                                    <div class="modal-content">   
                                        <div class="modal-header">  
                                            <h4 class="modal-title">Data Pangkat</h4>  
                                        </div>  
                                        <div class="modal-body">
                                            <input id="id" name="id" type="hidden" />
                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama lengkap</label>
                                                <input type="text" name ="nama" class="form-control" placeholder="Masukkan nama lengkap.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">NIP</label>
                                                <input type="text" name ="nip" class="form-control" placeholder="Masukkan NIP.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" name ="tempat_lahir" class="form-control" placeholder="Masukkan Tempat lahir.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" name ="tanggal_lahir" class="form-control" placeholder="Masukkan tanggal lahir.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Unit Kerja</label>
                                                <input type="text" name ="unit_kerja" class="form-control" placeholder="Masukkan Unit Kerja.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Instansi Induk</label>
                                                <input type="text" name ="instansi_induk" class="form-control" placeholder="Masukkan Instansi Kerja.." readonly required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Pendidikan</label>
                                                <input type="text" name ="pendidikan" class="form-control" placeholder="Masukkan Pendidikan.." required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" name ="jabatan" class="form-control" placeholder="Masukkan Jabatan.." required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Masa Kerja Golongan</label>
                                                <input type="text" name ="masa_kerja_golongan" class="form-control" placeholder="Masukkan Masa Kerja Golongan.." required />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Gaji Pokok</label>
                                                <input type="text" name ="gaji_pokok" class="form-control" placeholder="Masukkan Gaji Pokok.." required />
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

    
    
    $('#acc_usul_berkala_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id             = button.data('id');
        var spp                 = button.data('spp');
        var fc_sk_cpns_pns      = button.data('fc_sk_cpns_pns');
        var fc_ktp              = button.data('fc_ktp');
        var foto                = button.data('foto');
        var proses         = button.data('proses');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=spp]').prop('checked', spp);
        modal.find('.modal-body input[name=fc_sk_cpns_pns]').prop('checked',fc_sk_cpns_pns);
        modal.find('.modal-body input[name=fc_ktp]').prop('checked',fc_ktp);
        modal.find('.modal-body input[name=foto]').prop('checked',foto);
        modal.find('.modal-body select[name=proses]').val(proses);
    });

    
    
    $('#modal_print').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id                  = button.data('id');
        var nama                = button.data('nama');
        var nip                 = button.data('nip');
        var tempat_lahir       = button.data('tempat_lahir');
        var tanggal_lahir       = button.data('tanggal_lahir');
        var unit_kerja          = button.data('unit_kerja');
        var pendidikan          = button.data('pendidikan');
        var jabatan          = button.data('jabatan');
        var instansi_induk          = button.data('instansi_induk');
        var masa_kerja_golongan = button.data('masa_kerja_golongan');
        var pensiun_pokok       = button.data('pensiun_pokok');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=nama]').val(nama);
        modal.find('.modal-body input[name=nip]').val(nip);
        modal.find('.modal-body input[name=tempat_lahir]').val(tempat_lahir);
        modal.find('.modal-body input[name=tanggal_lahir]').val(tanggal_lahir);
        modal.find('.modal-body input[name=unit_kerja]').val(unit_kerja);
        modal.find('.modal-body input[name=pendidikan]').val(pendidikan);
        modal.find('.modal-body input[name=jabatan]').val(jabatan);
        modal.find('.modal-body input[name=instansi_induk]').val(instansi_induk);
        modal.find('.modal-body input[name=masa_kerja_golongan]').val(masa_kerja_golongan);
        modal.find('.modal-body input[name=pensiun_pokok]').val(pensiun_pokok);
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
</script>

<?php
require 'element/footer.php';
?>