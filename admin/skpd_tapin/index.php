<?php
    require 'element/header.php';
    $nip = $_SESSION['nip'];

    $query = "SELECT * FROM proses_usul_Berkala INNER JOIN data_pegawai ON proses_usul_Berkala.nip = data_pegawai.nip WHERE proses_usul_Berkala.nip = '$nip'";  
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
	};
	
    $_SESSION['pesan'] = '';
?>

<!-- [ Main Content ] start -->
<!-- <div class="pcoded-main-container"> -->
		<!-- <div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<!--  -->
												

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
	</div> -->
<!-- [ Main Content ] end -->



<?php
require 'element/footer.php';
?>