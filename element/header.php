<?php
	// Memanggil koneksi database
	require 'db_con/koneksi.php';
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
	<link rel="icon" href="assets/images/favicon.webp" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- JQuery -->
	<script src="assets/js/vendor-all.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="assets/plugins/data-tables/dataTables.bootstrap4.min.css">
	<script src="assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/data-tables/dataTables.bootstrap4.min.js"></script>

	<!-- CK Editor -->
	<!-- <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script> -->
	<!-- <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> -->
	<script src="assets/plugins/ck-editor/ckeditor.js"></script>
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
				<a href="dashboard.html" class="b-brand">
					<img src="assets/images/bkpsdm.png" alt="" class="logo images">
					<img src="assets/images/logo2.png" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption">
						<label>Dashboard</label>
					</li>
					<li class="nav-item">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Daftar Proses Berkala</span></a>
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
				<img src="assets/images/bkd.png" alt="" class="logo images">
				<img src="assets/images/favicon.webp" alt="" class="logo-thumb images">
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
						<a href="" data-toggle="modal" data-target="#input_login">
							<div class="dropdown drp-user">
								<button type="button" class="btn btn-outline-warning btn-sm">LOGIN</button>
							</div>
						</a>						
					</div>				
				</li>			
			</ul>
		</div>		
	</header>
	<!-- [ Header ] end -->

	                    <!-- Modal LOGIN -->
	                 
						<style>
						body {
						font-family: 'Varela Round', sans-serif;
						}
						.modal-login {		
							color: #636363;
							width: 350px;
						}
						@media (max-width: 768px) {
						.modal-login {
							left: 30px;
							width: 250px;
							height: 150px;
						}
						}
						.modal-login .modal-content {
							padding: 20px;
							border-radius: 5px;
							border: none;
						}
						.modal-login .modal-header {
							border-bottom: none;   
							position: relative;
							justify-content: center;
						}
						.modal-login h4 {
							text-align: center;
							font-size: 26px;
							margin: 30px 0 -15px;
						}
						.modal-login .form-control:focus {
							border-color: #70c5c0;
						}
						.modal-login .form-control, .modal-login .btn {
							min-height: 40px;
							border-radius: 3px; 
						}
						.modal-login .close {
							position: absolute;
							top: -5px;
							right: -5px;
						}	
						.modal-login .modal-footer {
							background: #ecf0f1;
							border-color: #dee4e7;
							text-align: center;
							justify-content: center;
							margin: 0 -20px -20px;
							border-radius: 5px;
							font-size: 13px;
						}
						.modal-login .modal-footer a {
							color: #999;
						}		
						.modal-login .avatar {
							position: absolute;
							margin: 0 auto;
							left: 0;
							right: 0;
							top: -70px;
							width: 95px;
							height: 95px;
							border-radius: 50%;
							z-index: 9;
							background: linear-gradient(45deg, #F57C00, #FFB64D);
							padding: 15px;
							box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
						}
						.modal-login .avatar img {
							width: 100%;
							height: 105%;
						}
						.modal-login.modal-dialog {
							margin-top: 80px;
						}
						.modal-login .btn, .modal-login .btn:active {
							color: #fff;
							border-radius: 4px;
							background: linear-gradient(45deg, #F57C00, #FFB64D);
							text-decoration: none;
							transition: all 0.4s;
							line-height: normal;
							border: none;
						}
						.modal-login .btn:hover, .modal-login .btn:focus {
							background: linear-gradient(45deg, rgb(247, 191, 135), rgb(245, 223, 192));
							outline: none;
						}
						.trigger-btn {
							display: inline-block;
							margin: 100px auto;
						}
						</style>

						<div id="input_login" class="modal fade">
							<div class="modal-dialog modal-login">
								<div class="modal-content">

									<div class="modal-header">
										<div class="avatar">
											<img src="assets/images/faviconn.webp" alt="Avatar">
										</div>				
										<h4 class="modal-title">Login</h4>	
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;	</button>
									</div>

									<div class="modal-body">
										<form action="fungsi/index.php" method="post">
											<div class="form-group">
												<input type="text" class="form-control" name="username" placeholder="Username" required="required">		
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Password" required="required">	
											</div>        
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
											</div>
										</form>
									</div>

									<div class="modal-footer">
										<a href="#!">Forgot Password?</a>
									</div>
								</div>
							</div>
						</div>      
               
			
