<?php
require 'element/header.php';

$query = mysqli_query($con,"SELECT data_pegawai.*, table_pensiun.id, table_pensiun.tmt_terakhir_jabatan, table_pensiun.tanggal_pensiun, table_pensiun.kategori_pensiun, table_pensiun.admin, table_pensiun.pimpinan, spp, fc_sk_cpns_pns, fc_ktp, foto, file_path_spp, file_path_sk, file_path_ktp, file_path_foto, table_pensiun.pangkat_lama, table_pensiun.pangkat_baru, table_pensiun.masa_kerja_golongan, table_pensiun.masa_kerja_pensiun, table_pensiun.berhenti_awal_bulan, table_pensiun.pensiun_tmt, table_pensiun.pensiun_pokok, table_pensiun.tmt_terakhir_jabatan, table_pensiun.tanggal_pensiun FROM table_pensiun INNER JOIN data_pegawai ON table_pensiun.nip = data_pegawai.nip ORDER BY table_pensiun.created_at DESC");

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
															<td><a href="<?= base_url($row['file_path_spp']);?>">Document Surat Permohonan Pensiun</a></td>
															<td><a href="<?= base_url($row['file_path_sk']);?>">Document Fotocopy SK CPNS & PNS</a></td>
															<td><a href="<?= base_url($row['file_path_ktp']);?>">Document Fotocopy KTP</a></td>
															<td><a href="<?= base_url($row['file_path_foto']);?>">Document Pas Photo 3x4</a></td>
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

                                                                    <a class="dropdown-item cetak_sk" href="#" data-toggle="modal" data-target="#modal_print"
                                                                    data-id="<?php echo $row['id'];?>" 
                                                                    data-nama="<?php echo $row['nama'];?>"
                                                                    data-nip="<?php echo $row['nip'];?>"
                                                                    data-tanggal_lahir="<?php echo $row['tanggal_lahir'];?>"
                                                                    data-unit_kerja="<?php echo $row['unit_kerja'];?>"
                                                                    data-pangkat_lama="<?php echo $row['pangkat_lama'] == '' ? $row['gol_awal_cpns'] . "/" . $row['tmt_cpns'] : $row['pangkat_lama'];?>"
                                                                    data-pangkat_baru="<?php echo $row['pangkat_baru'] == '' ? $row['gol_akhir'] . "/" . $row['tmt_gol_akhir'] : $row['pangkat_baru'];?>"
                                                                    data-masa_kerja_golongan="<?php echo $row['masa_kerja_golongan'];?>"
                                                                    data-masa_kerja_pensiun="<?php echo $row['masa_kerja_pensiun'];?>"
                                                                    data-berhenti_awal_bulan="<?php echo $row['berhenti_awal_bulan'];?>"
                                                                    data-pensiun_tmt="<?php echo $row['pensiun_tmt'];?>"
                                                                    data-pensiun_pokok="<?php echo $row['pensiun_pokok'];?>"
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


                        <!-- Modal Usul Berkala -->
                        <div id="modal_print" class="modal fade">  
                            <div class="modal-dialog">
                                <form method="POST"  enctype="multipart/form-data" action="cetak_sk/cetak_sk_pensiun.php">
                                <div class="modal-content">   
                                    <div class="modal-header">  
                                        <h4 class="modal-title">Data Pensiun</h4>  
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
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name ="tanggal_lahir" class="form-control" placeholder="Masukkan tanggal lahir.." readonly required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Unit Kerja</label>
                                            <input type="text" name ="unit_kerja" class="form-control" placeholder="Masukkan Unit Kerja.." readonly required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Pangkat/Gol.ruang Lama</label>
                                            <input type="text" name ="pangkat_lama" class="form-control" placeholder="Masukkan Pangkat/Gol.ruang Lama.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Pangkat/Gol.ruang Baru</label>
                                            <input type="text" name ="pangkat_baru" class="form-control" placeholder="Masukkan Pangkat/Gol.ruang Baru.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Masa Kerja Golongan</label>
                                            <input type="text" name ="masa_kerja_golongan" class="form-control" placeholder="Masukkan Masa Kerja Golongan.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Masa Kerja Pensiun</label>
                                            <input type="text" name ="masa_kerja_pensiun" class="form-control" placeholder="Masukkan Masa Kerja Pensiun.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Berhenti Awal Bulan</label>
                                            <input type="text" name ="berhenti_awal_bulan" class="form-control" placeholder="Masukkan Berhenti Awal Bulan.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Pensiun TMT</label>
                                            <input type="text" name ="pensiun_tmt" class="form-control" placeholder="Masukkan Pensiun TMT.." required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Pensiun Pokok</label>
                                            <input type="text" name ="pensiun_pokok" class="form-control" placeholder="Masukkan Pensiun Pokok.." required />
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
    
    $('#modal_print').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id                  = button.data('id');
        var nama                = button.data('nama');
        var nip                 = button.data('nip');
        var tanggal_lahir       = button.data('tanggal_lahir');
        var unit_kerja          = button.data('unit_kerja');
        var pangkat_lama        = button.data('pangkat_lama');
        var pangkat_baru        = button.data('pangkat_baru');
        var masa_kerja_golongan = button.data('masa_kerja_golongan');
        var masa_kerja_pensiun  = button.data('masa_kerja_pensiun');
        var berhenti_awal_bulan = button.data('berhenti_awal_bulan');
        var pensiun_tmt         = button.data('pensiun_tmt');
        var pensiun_pokok       = button.data('pensiun_pokok');
        var modal = $(this);
        modal.find('.modal-body input[name=id]').val(id);
        modal.find('.modal-body input[name=nama]').val(nama);
        modal.find('.modal-body input[name=nip]').val(nip);
        modal.find('.modal-body input[name=tanggal_lahir]').val(tanggal_lahir);
        modal.find('.modal-body input[name=unit_kerja]').val(unit_kerja);
        modal.find('.modal-body input[name=pangkat_lama]').val(pangkat_lama);
        modal.find('.modal-body input[name=pangkat_baru]').val(pangkat_baru);
        modal.find('.modal-body input[name=masa_kerja_golongan]').val(masa_kerja_golongan);
        modal.find('.modal-body input[name=masa_kerja_pensiun]').val(masa_kerja_pensiun);
        modal.find('.modal-body input[name=berhenti_awal_bulan]').val(berhenti_awal_bulan);
        modal.find('.modal-body input[name=pensiun_tmt]').val(pensiun_tmt);
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