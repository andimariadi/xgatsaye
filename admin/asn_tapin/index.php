<?php
    require 'element/header.php';
    $nip = $_SESSION['nip'];

    $query = "SELECT * FROM proses_usul_berkala INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip WHERE proses_usul_berkala.nip = '$nip'";  
    $result = mysqli_query($con, $query);

    // Alert Hapus Berkas
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
        echo '<script>swal("Success", "Berkas berhasil dihapus !", "success");</script>';
    }
    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '1') {
        echo '<script>swal("Error", "Berkas gagal dihapus, coba lagi !", "error");</script>';
    }

    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '3') {
        echo '<script>swal("Success", "Berkas berhasil di upload !", "success");</script>';
    }
    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '4') {
        echo '<script>swal("Error", "Berkas gagal diupload, coba lagi !", "error");</script>';
    }
    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '5') {
        echo '<script>swal("Error", "File yang anda upload bukan pdf !", "error");</script>';
    }

    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '6') {
        echo '<script>swal("Success", "Berhasil dikirim !", "success");</script>';
    }
    elseif (isset($_SESSION['pesan']) && $_SESSION['pesan'] == '7') {
        echo '<script>swal("Error", "Gagal dikirim !", "error");</script>';
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
												<h5>Home</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Upload Berkas</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">			
																							
                                <!-- sessions-section start -->
                                <div class="col-xl-4 col-md-6">
									<div class="card user-card">
										<div class="card-header" style="background-color: #cecece;">
											<h5>Profile</h5>
										</div>
										<div class="card-body  text-center">
										
												<?php
													$row = mysqli_fetch_array($result);

													$kategori = $row['kategori'];
													$pemberkasan_status = $row['pemberkasan_status'];
												?>
											<div class="usre-image">
												<img src="../../assets/images/widget/img-round1.webp" class="img-radius wid-100 m-auto" alt="User-Profile-Image">
											</div>
											<h6 class="f-w-600 m-t-25 m-b-10">
												<?php
													$gelar_depan = $row['gelar_depan'];
													$nama = $row['nama'];
													$gelar_belakang = $row['gelar_belakang'];

													if ($gelar_depan == '') {
														$spasi = '';
													} else {
														$spasi = ' ';
													};

													if ($gelar_belakang == '') {
														$koma = '';
													} else {
														$koma = ', ';
													};

													$nama_result = $gelar_depan . $spasi . $nama . $koma . $gelar_belakang;

													echo "$nama_result";
												?>
											</h6>
											<p> <?= $row['nip']; ?> | <?= $row['gol_akhir']; ?> | 
												<?php
													$tempat_lahir = $row['tempat_lahir'];
													$tanggal_lahir = $row['tanggal_lahir'];

													$hari = (int) substr($tanggal_lahir, 8, 2);
													$bulan = (int) substr($tanggal_lahir, 5, 2);
													$tahun = (int) substr($tanggal_lahir, 0, 4);
													$hari = sprintf("%02s", $hari);
													$bulan = sprintf("%02s", $bulan);
													$tahun = sprintf("%04s", $tahun);
													$char1 = "-";
													$tanggal_hasil = $hari . $char1 . $bulan . $char1 . $tahun;

													$char2 = ', ';

													$ttl = $tempat_lahir . $char2 . $tanggal_hasil;

													echo "$ttl";
												?>
											</p>
											<p class="m-t-15"><?= $row['unit_kerja_induk']; ?></p>
											<hr>
											<h6 class="f-w-600 m-t-15"><?= $row['keterangan']; ?></h6>

											<div class="counter-block m-t-10 p-20" style="background-color: #cecece;">
												<?php
													$berkas_status = $row['pemberkasan_status'];
													if ($berkas_status == 'Belum Mengisi') {
														$warna = "text-white";
														$berkas_status1 = "BELUM MENGISI";
													}
													elseif ($berkas_status == 'Belum Lengkap') {
														$warna = "text-success";
														$berkas_status1 = "BELUM LENGKAP";
													}
													elseif ($berkas_status == 'Lengkap') {
														$warna = "text-warning";
														$berkas_status1 = "LENGKAP";
													}
													elseif ($berkas_status == 'Berkas Masuk') {
														$warna = "text-light";
														$berkas_status1 = "BELUM DIPERIKSA";
													}
													else
														$berkas_status1 = "$berkas_status";
												?>
												<div class="row justify-content-center">														
													<div class="col-4 ">
														<i class="fas fa-folder-open text-white f-20"></i>													
														<p class="<?= $warna; ?> mt-2 mb-0"><?= $berkas_status1; ?></p>	
													</div>
												</div>
											</div>
											<p class="f-w-600 m-t-15"><i class="fas fa-copyright"></i>  Badan Kepegawaian dan Pengembangan Sumberdaya Manusia</p>
											<hr>  

										</div>
									</div> 
								</div>

								<div class="col-md-8 col-xl-8">
									<div class="card" style="min-height: 532px;">
                                        <div class="card-header" style="background-color: #cecece;">
                                            <h5>Upload Berkas Berkala</h5>
                                        </div>

                                        <div class="card-body table-border-style">
											<div class="row">
                                                <div class="col-md-12">
												<?php
													if ($pemberkasan_status == 'Lengkap') {
														// Tombol Upload Dihapus
													}
													else {
														echo '
															<button type="button" class="btn btn-outline-warning upload_berkas1" data-toggle="modal" data-target="#upload_berkas1">
															<i class="fas fa-upload"></i>
																UPLOAD BERKAS
															</button>
														';
													};
												?>                                                    
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead>
													    <tr class="text-center">
															<th class="align-middle" style="background-color: #cecece; width: 1%" >No</th>
															<th class="align-middle" style="background-color: #cecece; width: 15%" >Nama Berkas</th>
															<th class="align-middle" style="background-color: #cecece; width: 8%" >Status</th>
															<th class="align-middle" style="background-color: #cecece; width: 5%" >Action</th>
														</tr>
                                                    </thead>
                                                    <tbody> 
																<?php
																	$query2 = mysqli_query($con,"SELECT * FROM berkas WHERE nip = '$nip' ORDER BY id DESC");
																	if(mysqli_num_rows($query2)>0){
																?>
																<?php
																	$no = 1;
																	while($row2 = mysqli_fetch_array($query2)){
																?>                                    
													    <tr>
															<td class="text-center border"><?php echo $no; ?></td>
															<td class="text-left border"><?php echo $row2['nama_berkas']?></td>
															<td class="text-left border text-center align-middle">
																<?php
																	$status_berkas = $row2['status'];

																	if ($status_berkas == 'Belum Diperiksa') {
																		echo '<span class="badge badge-warning">BELUM DIPERIKSA</span>';
																	}
																	elseif ($status_berkas == 'Benar') {
																		echo '<span class="badge badge-success">BENAR</span>';
																	}
																	elseif ($status_berkas == 'Salah') {
																		echo '<span class="badge badge-danger">SALAH</span>';
																	}
																?>                                  
															</td>
															<td class="border text-center align-middle">
																<div class="dropdown">
																<button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	Action
																</button>
																	<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

																		<?php
																			$berkas = $row2['file'];
																			$lokasi_berkas = "../berkas/" . $kategori . "/" . $nip . "/" . $berkas;
																			$lokasi_berkas_hapus = $_SERVER['DOCUMENT_ROOT'] . "/berkala/admin/berkas/" . $kategori . "/" . $nip . "/" . $berkas;
																		?>
																		<a class="dropdown-item buka-berkas" href="#" name="view" value="View" data-berkas="<?= $lokasi_berkas ?>"></i>
																			Buka
																		</a>

																		<?php                                                    
																			$status = $row2['status'];
																			$id = $row2['id'];
																			if ($status == 'Benar') {
																				// Kosong
																			}
																			else {
																				echo '
																				<a class="dropdown-item text-danger hapus_berkas" href="#" name="view" value="View" data-id_berkas="' . $id . '" data-berkas="' . $lokasi_berkas_hapus . '">
																				<i class="fas fa-trash"></i>
																					Hapus
																				</a>
																				';
																			};                                               
																		?>
																										
																	</div>                                                  
																</div>                               
															</td>
														</tr>
														<?php $no++; } ?>
														<?php } ?>                                                 
                                                    </tbody>
												

												<script type="text/javascript">
													// Script Modal Buka Berkas
													$(document).ready(function(){
														$('.buka-berkas').click(function(){
															var berkas = $(this).data("berkas")
															$.ajax({
																url: "modal/lihat_berkas.php",
																method: "POST",
																data: {berkas: berkas},
																success: function(data){
																	$("#buka_berkas").html(data)
																	$("#buka_berkas_modal").modal('show')
																}
															})
														})
													})

													// Script Modal Hapus Berkas
													$(document).ready(function(){
														$('.hapus_berkas').click(function(){
															var berkas = $(this).data("berkas")
															var id_berkas = $(this).data("id_berkas")
															$.ajax({
																url: "modal/hapus_berkas.php",
																method: "POST",
																data: {berkas: berkas, id_berkas: id_berkas},
																success: function(data){
																	$("#hapus_berkas").html(data)
																	$("#hapus_berkas_modal").modal('show')
																}
															})
														})
													})
												</script>

                                                </table>

												<!-- Modal Buka Berkas -->
												<div id="buka_berkas_modal" class="modal fade">  
													<div class="modal-dialog modal-lg">  
														<div class="modal-content">   
															<div class="modal-body" id="buka_berkas">
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

												<!-- Modal Hapus Berkas -->
												<div id="hapus_berkas_modal" class="modal fade">  
													<div class="modal-dialog">  
														<div class="modal-content">   
															<div class="modal-body" id="hapus_berkas">
															<!-- Modal Body -->
															</div>
														</div>  
													</div>  
												</div>

												<!-- Modal Upload Berkas -->
												<div id="upload_berkas1" class="modal fade">  
													<div class="modal-dialog">  
														<div class="modal-content">  
															<div class="modal-header text-center">  
																<h4 class="modal-title">UPLOAD BERKAS</h4>  
															</div>  
															<div class="modal-body">
																<div class="row">
																	<div class="col-12">
																		<form method="post" action="fungsi/upload_berkas.php" class="text-center pt-1" enctype="multipart/form-data">

																			<input hidden type="text" name="nip" value="<?= $nip ?>">
																			<input hidden type="text" name="kategori" value="<?= $kategori ?>">

																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 100px">Upload</span>
																				</div>
																				<input type="file" class="form-control bg-white" name="file" >
																			</div>

																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="btn  text-left input-group-text" style="background-color: #eff3f6; width: 100px">File</span>
																				</div>
																				<select class="custom-select bg-white" id="inputGroupSelect01" type="text" name="nama_berkas" required>
																					<option value="">.: Jenis File :.</option>

																					<!-- List Berkas -->
																					<?php
																						$query_berkas = mysqli_query($con,"SELECT * FROM list_berkas ORDER BY id DESC");
																						while($row_berkas = mysqli_fetch_array($query_berkas)){
																					?>																				
																					<option value="<?php echo $row_berkas['berkas']?>"><?php echo $row_berkas['berkas']?></option>
																					<?php } ?>
																				</select>
																			</div>																		

																			<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 160px; height: 40px">
																			<i class="far fa-times-circle"></i>
																				Close
																			</button>

																			<button type="button submit" value="OK" class="btn btn-warning" style="width: 160px; height: 40px">
																			<i class="fas fa-upload"></i>
																				Upload
																			</button>
																			
																		</form>  
																	</div>
																</div>
															</div> 
														</div>  
													</div>  
												</div>

												<form class="text-center mt-4" method="post" action="fungsi/kirim.php">
													<input hidden type="text" name="nip" value="<?= $nip; ?>">
													<?php
														if ($pemberkasan_status == 'Lengkap') {
															// Tombol Kirim Dihapus
														}
														else {
															echo '
																<button type="button submit" value="OK" class="btn btn-warning" style="width: 150px; height: 40px">
																<i class="fas fa-paper-plane"></i>
																	KIRIM
																</button>
															';
														};
													?>                                    
												</form>

                                            </div>
                                        </div>
                                    </div>
								
								</div>
								

                            </div>
							<script>
								$(document).ready(function() {
									$('#example').DataTable();
								});
							</script>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- [ Main Content ] end -->



<?php
require 'element/footer.php';
?>