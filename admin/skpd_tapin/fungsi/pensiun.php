<?php 
session_start();
 
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
	$fileTmpPath = $_FILES['document']['tmp_name'];
	$fileName = $_FILES['document']['name'];
	$fileSize = $_FILES['document']['size'];
	$fileType = $_FILES['document']['type'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$newFileName = "pensiun_".md5(time() . $fileName) . '.' . $fileExtension;
} else {
	$_SESSION['msg'] = "Swal.fire({
		icon: 'error',
		title: 'Tidak ada document yang diupload!',
		showConfirmButton: false,
		timer: 1500
	  });";
	header('location:../data_pegawai.php');
	return;
}

$filePath = "";
$allowedfileExtensions = array('pdf');
if (in_array($fileExtension, $allowedfileExtensions)) {
	$uploadFileDir = buatFolderUpload();
	$dest_path = $uploadFileDir . $newFileName;
	
	move_uploaded_file($fileTmpPath, $dest_path);

	$filePath = filePath("document", $newFileName);
} else {
	$_SESSION['msg'] = "Swal.fire({
		icon: 'error',
		title: 'Document tidak valid!',
		showConfirmButton: false,
		timer: 1500
	  });";
	header('location:../data_pegawai.php');
	return;
}
?>
<?php
	if($filePath == "") {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Tidak ada document yang diupload!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pegawai.php');
		return;
	}
	require '../../../db_con/koneksi.php';
	
	$to_email = 'mbie.oby@gmail.com';
	$to_nama = 'Ayu Dayanti';
	$to_subject = 'Informasi: Pembuatan Data Pensiun baru';
	$to_body = 'Hi Admin, kami menginformasikan bahwa ada penginputan data dari SKPD dan harus memberikan approval dari Anda. Segera lihat admin panel untuk melakukan aproval.';

	require '../../../plugins/kirim.php';


	$nip = htmlentities(trim( $_POST['nip']));
	$tmt_terakhir_jabatan = htmlentities(trim( $_POST['tmt_terakhir_jabatan']));
	$tanggal_pensiun = htmlentities(trim( $_POST['tanggal_pensiun']));
	$kategori_pensiun = htmlentities(trim( $_POST['kategori_pensiun']));

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT nip FROM table_pensiun WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_pangkat);

	if ($usul > 0) {
		$_SESSION['pesan'] = '9';
		header('location:../data_pegawai.php');
	}
	else {

	// SQL
	$sql = "INSERT INTO `$db_name`.`table_pensiun` (`nip`, `tmt_terakhir_jabatan`, `tanggal_pensiun`, `kategori_pensiun`, `file_path`) VALUES ('$nip', '$tmt_terakhir_jabatan','$tanggal_pensiun', '$kategori_pensiun', '$filePath')";
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = '1';
		header('location:../data_pegawai.php');
	}
	else
		$_SESSION['pesan'] = '1';
		header('location:../data_pegawai.php');
	};	
?>