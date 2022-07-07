<?php 
session_start();
 
if($_SESSION['level'] !="admin" && $_SESSION['level'] !="pimpinan"){
    header("location:../index.php");
    }
?>
<?php
	// Memanggil koneksi database
	require '../db_con/koneksi.php';
	require 'fungsi/perhitungan_pemberkasan.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>BKPSDM Kab. Tapin</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="../assets/images/favicon.webp" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="../assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="../assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="../assets/css/style.css">

	<!-- JQuery -->
	<script src="../assets/js/vendor-all.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/data-tables/dataTables.bootstrap4.min.css">
	<script src="../assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/data-tables/dataTables.bootstrap4.min.js"></script>

	<!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/dist/sweetalert.css">
    <script src="../assets/plugins/sweetalert/dist/sweetalert-dev.js"></script>

	
    <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/dist/sweetalert2.min.css">
    <script src="../assets/plugins/sweetalert/dist/sweetalert2.min.js"></script>
</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-purple ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="#!" class="b-brand">
					<img src="../assets/images/bkpsdm.png" alt="" class="logo images">
					<img src="../assets/images/logo2.png" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">

					<li class="nav-item pcoded-menu-caption">
						<label>Dashboard</label>
					</li>

					<li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Beranda</span></a>
					</li>
					<?php if($_SESSION['level'] == 'admin'):?>

					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Database</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="data_pegawai.php" class="">Data Pegawai</a></li>
							<li class=""><a href="data_gaji.php" class="">Data Gaji</a></li>
							<li class=""><a href="data_user.php" class="">Data Akun User</a></li>
						</ul>
					</li>

					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fas fa-bell"></i></span><span class="pcoded-mtext">Notifikasi</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="notification_usulan_pangkat.php" class="">Usulan Pangkat</a></li>
							<li class=""><a href="notification_kenaikan_gaji.php" class="">Kenaikan Gaji</a></li>
							<li class=""><a href="notification_pensiun.php" class="">Pensiun</a></li>
						</ul>
					</li>

					<li class="nav-item pcoded-menu-caption">
						<label>Menu</label>
					</li>

					<li class="nav-item">
						<a href="ajuan_berkala.php" class="nav-link"><span class="pcoded-micon"><i class="fas fa-align-left"></i></span><span class="pcoded-mtext">Daftar Diajukannya Berkala
								<?php
                                    if ($ajuan_masuk > 0) {
                                        echo '<span class="badge badge-light ml-2 bg-dark text-white">' . $ajuan_masuk . '</span>';
                                    }
                                ?> 
						</span></a>
					</li>

					<li class="nav-item">
						<a href="usul_berkala.php" class="nav-link"><span class="pcoded-micon"><i class="far fa-list-alt"></i></span><span class="pcoded-mtext">Daftar Proses Berkala
								<?php
                                    if ($proses_berkalaa > 0) {
                                        echo '<span class="badge badge-light ml-2 bg-dark text-white">' . $proses_berkalaa . '</span>';
                                    }
                                ?>
						</span></a>
					</li>

					<li class="nav-item">
						<a href="arsip.php" class="nav-link"><span class="pcoded-micon"><i class="fa fa-archive"></i></span><span class="pcoded-mtext">Arsip
								<?php
                                    if ($arsipp > 0) {
                                        echo '<span class="badge badge-light ml-2 bg-dark text-white">' . $arsipp . '</span>';
                                    }
                                ?>
						</span></a>
					</li>

					<li class="nav-item">
						<a href="data_pensiun.php" class="nav-link"><span class="pcoded-micon"><i class="far fa-list-alt"></i></span><span class="pcoded-mtext">Daftar Pensiun <?php if($pengsiun > 0) echo '<span class="badge badge-light ml-2 bg-dark text-white">' . $pengsiun . '</span>';?></span></a>
					</li>

					<li class="nav-item">
						<a href="data_pangkat.php" class="nav-link"><span class="pcoded-micon"><i class="far fa-list-alt"></i></span><span class="pcoded-mtext">Daftar Pengajuan Pangkat <?php if($pangkat > 0) echo '<span class="badge badge-light ml-2 bg-dark text-white">' . $pangkat . '</span>';?></span></a>
					</li>
					<?php endif;?>
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Laporan
						</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="cetak_datapegawai.php" class="">Data Pegawai
							</a></li>
							<li class=""><a href="cetak_dataarsip.php" class="">Data Arsip
							</a></li>
							<li class=""><a href="cetak_ajuan.php" class="">Data Daftar Diajukannya Berkala
							</a></li>
							<li class=""><a href="cetak_proses.php" class="">Data Daftar Proses Berkala
							</a></li>
							<li class=""><a href="cetak_pensiun.php" class="">Data Daftar Pensiun
							</a></li>
							<li class=""><a href="cetak_pangkat.php" class="">Data Daftar Pangkat Tujuan
							</a></li>
							<li class=""><a href="cetak_proses_pensiun.php" class="">Data Daftar Proses Pensiun
							</a></li>
							<li class=""><a href="cetak_proses_pangkat.php" class="">Data Daftar Proses Pangkat Tujuan
							</a></li>
							<li class=""><a href="cetak_berkas_ajuan.php" class="">Data Berkas Tujuan Berkala
							</a></li>
							<li class=""><a href="cetak_berkas_pensiun.php" class="">Data Berkas Pensiun
							</a></li>
							<li class=""><a href="cetak_berkas_pangkat.php" class="">Data Berkas Pangkat
							</a></li>
							
							<li class=""><a href="data_filter_ajuan_berkala.php" class="">Data Waktu Diajukan Berkala
							</a></li>
							
							<li class=""><a href="data_filter_proses.php" class="">Data Waktu Proses Berkala
							</a></li>
							
							<li class=""><a href="data_filter_arsip.php" class="">Data Waktu Arsip
							</a></li>

							<li class=""><a href="data_filter_pangkat.php" class="">Data Waktu Berkas Pangkat
							</a></li>
							<li class=""><a href="data_filter_pensiun.php" class="">Data Waktu Berkas Pensiun
							</a></li>
						</ul>
					</li>
					
				</ul>
			</div>
				<div class="sb-sidenav-footer">
					<div class="small">Logged in as:</div>
					<?php
						$username = $_SESSION['username'];
						$user = mysqli_query($con,"SELECT * FROM user WHERE username = '$username'");
						while($row = mysqli_fetch_array($user)) {
						echo $row['nama'];
					} ?>
				</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="#!" class="b-brand">
				<img src="../assets/images/bkd.png" alt="" class="logo images">
				<img src="../assets/images/favicon.webp" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<a href="#!" class="mob-toggler"></a>
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-user"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<ul class="pro-body">
								<li><a href="../index.php" class="dropdown-item"><i class="feather icon-user"></i> Logout</a></li>
								<li><a  href="#!" class="dropdown-item" data-toggle="modal" data-target="#ganti_password"><i class="feather icon-settings"></i> Ganti Password</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>		
	</header>
	<!-- [ Header ] end -->

	<!-- Modal Ganti Password -->
	<div id="ganti_password" class="modal fade">  
		<div class="modal-dialog">  
			<div class="modal-content">  
				<div class="modal-header text-center">  
					<h4 class="modal-title">Ganti Password</h4>  
				</div>  
				<div class="modal-body" >
					<div class="row">
						<div class="col-12">
							<form method="post" action="fungsi/update_password.php" class="text-center pt-1 pb-1">

								<input  hidden type="text" name="username" value="<?= $username ?>">

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" style="width: 170px">Password Lama</span>
									</div>
									<input type="password" id="password1" class="form-control bg-white" name="password_lama">
								</div>	
								
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" style="width: 170px">Passsword Baru</span>
									</div>
									<input type="password" id="password2" class="form-control bg-white" name="password_baru">
								</div>
								
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" style="width: 170px">Konfirmasi Password</span>
									</div>
									<input type="password" id="password3" class="form-control bg-white" name="konfirmasi_password">
								</div>

								<div class="custom-control custom-checkbox text-right mb-2">
									<input type="checkbox" class="custom-control-input" id="show-password">
									<label class="custom-control-label" for="show-password">Show Password</label>
								</div>

								<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 120px; height: 40px">
								<i class="far fa-times-circle"></i>
									Close
								</button>

								<button type="button submit" value="OK" class="btn btn-warning" style="width: 120px; height: 40px">
								<i class="far fa-save"></i>
									Simpan
								</button>
							</form>

							<script>
								$(document).ready(function(){  
								$('#show-password').click(function(){
								if($(this).is(':checked')){
									$('#password1, #password2, #password3').attr('type','text');
								}else{
									$('#password1, #password2, #password3').attr('type','password');
								}
								});
								});
							</script>

						</div>
					</div>
				</div> 
			</div>  
		</div>  
	</div>

		
