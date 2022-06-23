<?php 
session_start();
 
// \
<?php
	// Memanggil koneksi database
	require '../../db_con/koneksi.php';
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

	<!-- Favicon icon -->
	<link rel="icon" href="../../assets/images/favicon.webp" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="../../assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="../../assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="../../assets/css/style.css">

	<!-- JQuery -->
	<script src="../../assets/js/vendor-all.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="../../assets/plugins/data-tables/dataTables.bootstrap4.min.css">
	<script src="../../assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script src="../../assets/plugins/data-tables/dataTables.bootstrap4.min.js"></script>

	<!-- Sweetalert -->
	<link rel="stylesheet" type="text/css" href="../../plugin/sweetalert/dist/sweetalert.css">
    <script src="../../assets/plugins/sweetalert/dist/sweetalert-dev.js"></script>
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
					<img src="../../assets/images/bkpsdm.png" alt="" class="logo images">
					<img src="../../assets/images/logo2.png" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">

					<li class="nav-item pcoded-menu-caption">
						<label>Dashboard</label>
					</li>

					<li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Upload Berkas</span></a>
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
				<img src="../../assets/images/bkd.png" alt="" class="logo images">
				<img src="../../assets/images/favicon.webp" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<a href="#!" class="mob-toggler"></a>
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
						<div class="dropdown-menu dropdown-menu-right notification">
							<div class="noti-head">
								<h6 class="d-inline-block m-b-0">Notifications</h6>
							</div>
							<ul class="noti-body">
							
							</ul>
						</div>
					</div>
				</li>
				<li>
					<div class="dropdown drp-user">
						<a href="../../index.php">
							<div class="dropdown drp-user">
								<button type="button" class="btn btn-outline-warning btn-sm">LOGOUT</button>
							</div>
						</a>						
					</div>				
				</li>			
			</ul>
		</div>		
	</header>
	<!-- [ Header ] end -->

			
