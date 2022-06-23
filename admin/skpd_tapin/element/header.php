<?php 
session_start();
 
if($_SESSION['level'] !="skpd"){
    header("location:index.php");
    }
?>
<?php
	// Memanggil koneksi database
	require '../../db_con/koneksi.php';
	$skpd = $_SESSION['skpd'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />
	<title>Berkala SKPD</title>

	<!-- Favicon icon -->
	<link rel="icon" href="../../../assets/images/favicon.webp" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="../../../assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="../../../assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="../../../assets/css/style.css">

	<!-- JQuery -->
	<script src="../../../assets/js/vendor-all.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="../../../assets/plugins/data-tables/dataTables.bootstrap4.min.css">
	<script src="../../../assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script src="../../../assets/plugins/data-tables/dataTables.bootstrap4.min.js"></script>

	<!-- Sweetalert -->
	<link rel="stylesheet" type="text/css" href="../../../assets/plugins/sweetalert/dist/sweetalert2.min.css">
    <script src="../../../assets/plugins/sweetalert/dist/sweetalert2.min.js"></script>
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
					<img src="../../../assets/images/bkpsdm.png" alt="" class="logo images">
					<img src="../../../assets/images/logo2.png" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">

					<li class="nav-item pcoded-menu-caption">
						<label>Dashboard</label>
					</li>

					<!-- <li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="far fa-list-alt"></i></span><span class="pcoded-mtext">Daftar Proses Berkala</span></a>
					</li> -->

					<li class="nav-item">
						<a href="ajuan_berkala.php" class="nav-link"><span class="pcoded-micon"><i class="fas fa-align-left"></i></span><span class="pcoded-mtext">Daftar Usulan Berkala</span></a>
					</li>
					
					<li class="nav-item">
						<a href="data_pensiun.php" class="nav-link"><span class="pcoded-micon"><i class="fas fa-align-left"></i></span><span class="pcoded-mtext">Daftar Pensiun</span></a>
					</li>
					
					<li class="nav-item">
						<a href="data_pangkat.php" class="nav-link"><span class="pcoded-micon"><i class="fas fa-align-left"></i></span><span class="pcoded-mtext">Daftar Pangkat</span></a>
					</li>

					<li class="nav-item">
						<a href="data_pegawai.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Kirim Usul Pegawai</span></a>
					</li>

					
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="#!" class="b-brand">
				<img src="../../../assets/images/bkd.png" alt="" class="logo images">
				<img src="../../../assets/images/favicon.webp" alt="" class="logo-thumb images">
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
								<li><a href="../../index.php" class="dropdown-item"><i class="feather icon-user"></i> Logout</a></li>
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


			
