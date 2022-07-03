<?php
require 'element/header.php';
require 'fungsi/perhitungan.php';

$tahun = date('Y');
if(isset($_GET['tahun'])) {
	$tahun = htmlentities(trim( $_GET['tahun'] ));
}




$hitungGaji = "SELECT COUNT(data_pegawai.nip) pegawai, COUNT(riwayat_usul_berkala.id) usulan FROM `data_pegawai`
LEFT JOIN riwayat_usul_berkala ON data_pegawai.nip = riwayat_usul_berkala.nip AND YEAR(riwayat_usul_berkala.tanggal_selesai) = '{$tahun}';";
$rowGaji = mysqli_fetch_array( mysqli_query($con, $hitungGaji) );

$hitungPangkat = "SELECT COUNT(data_pegawai.nip) pegawai, COUNT(table_pangkat.id) usulan FROM `data_pegawai`
LEFT JOIN table_pangkat ON data_pegawai.nip = table_pangkat.nip AND YEAR(table_pangkat.created_at) = '{$tahun}';";
$rowPangkat = mysqli_fetch_array( mysqli_query($con, $hitungPangkat) );

$hitungPensiun = "SELECT COUNT(data_pegawai.nip) pegawai, COUNT(table_pensiun.id) usulan FROM `data_pegawai`
LEFT JOIN table_pensiun ON data_pegawai.nip = table_pensiun.nip AND YEAR(table_pensiun.tanggal_pensiun) = '{$tahun}';";
$rowPensiun = mysqli_fetch_array( mysqli_query($con, $hitungPensiun) );
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
											<li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- [ breadcrumb ] end -->
						<!-- [ Main Content ] start -->
						<div class="row">

							<!-- product profit start -->
							<div class="col-xl-3 col-md-6">
								<div class="card prod-p-card bg-c-red">
									<div class="card-body">
										<div class="row align-items-center m-b-25">
											<div class="col">
												<h4 class="m-b-5 text-white">Total Ajuan Masuk</h4>
												<h2 class="m-b-0 text-white"><?= $ajuan ?></h2>
											</div>
											<div class="col-auto">
												<i class="fas fa-tags text-c-red f-18"></i>
											</div>
										</div>

									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6">
								<div class="card prod-p-card bg-c-blue">
									<div class="card-body">
										<div class="row align-items-center m-b-25">
											<div class="col">
												<h4 class="m-b-5 text-white">Berkala Diproses</h4>
												<h2 class="m-b-0 text-white"><?= $proses ?></h2>
											</div>
											<div class="col-auto">
												<i class="fas fa-database text-c-blue f-18"></i>
											</div>
										</div>

									</div>
								</div>
							</div>

							<!-- <div class="col-xl-3 col-md-6">
								<div class="card prod-p-card bg-c-green">
									<div class="card-body">
										<div class="row align-items-center m-b-25">
											<div class="col">
												<h4 class="m-b-5 text-white">Berkas Masuk</h4>
												<h2 class="m-b-0 text-white"><?= $pemberkasan ?></h2>
											</div>
											<div class="col-auto">
												<i class="fas fa-book text-c-green f-18"></i>
											</div>
										</div>

									</div>
								</div>
							</div> -->

							<div class="col-xl-3 col-md-6">
								<div class="card prod-p-card bg-c-yellow">
									<div class="card-body">
										<div class="row align-items-center m-b-25">
											<div class="col">
												<h4 class="m-b-5 text-white">Total Arsip (<?= $tahun ?>)</h4>
												<h2 class="m-b-0 text-white"><?= $arsipp ?></h2>
											</div>
											<div class="col-auto">
												<i class="fas fa-archive text-c-yellow f-18"></i>
											</div>
										</div>

									</div>
								</div>
							</div>
							
							<div class="col-xl-3 col-md-6">
								<div class="card prod-p-card bg-c-green">
									<div class="card-body">
										<div class="row align-items-center m-b-25">
											<div class="col">
												<h4 class="m-b-5 text-white">Data Pegawai</h4>
												<h2 class="m-b-0 text-white"><?= $pegawai ?></h2>
											</div>
											<div class="col-auto">
												<i class="fas fa-male text-c-blue f-18"></i>
											</div>
										</div>

									</div>
								</div>
							</div>	
						</div>

						<div class="card">
							<div class="card-body">

								<form>
									<div class="row mb-2">
										<div class="col-md-4">
											<select class="form-control" name="tahun">
												<?php for ($i= date('Y'); $i > 2000; $i--) { 
													$selected = $i == $tahun ? " selected": "";
													echo '<option value="'.$i.'"'.$selected.'>' .$i .'</option>';
												}
												?>
											</select>
										</div>
										<div class="col-md-4">
											<button type="submit" class="btn btn-primary">Filter</button>
										</div>
									</div>
								
								</form>
		
								<div class="row">
									<div class="col-md-4">
										
										<div class="card">
											<div class="card-header">
												<h3>Usulan Gaji</h3>
											</div>
											<div class="card-body">
												<canvas id="usulan_berkala" width="400" height="400"></canvas>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										
										<div class="card">
											<div class="card-header">
												<h3>Pangkat</h3>
											</div>
											<div class="card-body">
												<canvas id="pangkat" width="400" height="400"></canvas>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										
										<div class="card">
											<div class="card-header">
												<h3>Pensiun</h3>
											</div>
											<div class="card-body">
												<canvas id="pensiun" width="400" height="400"></canvas>
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

<script src="../assets/js/chart.min.js"></script>
<script>
const ctx = document.getElementById('usulan_berkala');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jumlah Pegawai', 'Riwayat Usulan Berkala'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $rowGaji['pegawai'] . ',' . $rowGaji['usulan'];?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


const ctx2 = document.getElementById('pangkat');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Jumlah Pegawai', 'Usulan Pangkat'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $rowPangkat['pegawai'] . ',' . $rowPangkat['usulan'];?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx3 = document.getElementById('pensiun');
const myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Jumlah Pegawai', 'Usulan Pensiun'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $rowPensiun['pegawai'] . ',' . $rowPensiun['usulan'];?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<?php
require 'element/footer.php';
?>
