<?php 
session_start();
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_form']) && $_FILES['document_form']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_sk_berkala']) && $_FILES['document_sk_berkala']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_sk_pangkat']) && $_FILES['document_sk_pangkat']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_sk_jabatan']) && $_FILES['document_sk_jabatan']['error'] === UPLOAD_ERR_OK)
) {
	$fileTmpPath = $_FILES['document_form']['tmp_name'];
	$fileName = $_FILES['document_form']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_form = "document_form_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_form = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_form;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_form = filePath("document", $document_form);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Form Usul Berkala tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	$fileTmpPath = $_FILES['document_sk_berkala']['tmp_name'];
	$fileName = $_FILES['document_sk_berkala']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_sk_berkala = "document_sk_berkala_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_sk_berkala = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_sk_berkala;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_sk_berkala = filePath("document", $document_sk_berkala);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document SK Berkala Terakhir tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	

	$fileTmpPath = $_FILES['document_sk_pangkat']['tmp_name'];
	$fileName = $_FILES['document_sk_pangkat']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_sk_pangkat = "document_sk_pangkat_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_sk_pangkat = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_sk_pangkat;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_sk_pangkat = filePath("document", $document_sk_pangkat);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document SK Pangkat Terakhir tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	$fileTmpPath = $_FILES['document_sk_jabatan']['tmp_name'];
	$fileName = $_FILES['document_sk_jabatan']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_sk_jabatan = "document_sk_jabatan_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_sk_jabatan = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_sk_jabatan;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_sk_jabatan = filePath("document", $document_sk_jabatan);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document SK Pemangku Jabatan tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}
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


?>
<?php
	if(
		$filePath_document_form == "" ||
		$filePath_document_sk_berkala == "" ||
		$filePath_document_sk_pangkat == "" ||
		$filePath_document_sk_jabatan == ""
	) {
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
	$to_subject = 'Informasi: Pembuatan Data Usul Berkala baru';
	$to_body = 'Hi Admin, kami menginformasikan bahwa ada penginputan data dari SKPD dan harus memberikan approval dari Anda. Segera lihat admin panel untuk melakukan aproval.';

	require '../../../plugins/kirim.php';

	date_default_timezone_set("Asia/Singapore");
	$tanggal = date("Y-m-d");

	$nip = $_POST['nip'];
	$no_hp_lama = $_POST['no_hp_lama'];
	$no_hp_baru = $_POST['no_hp_baru'];

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT nip FROM ajuan_usul_berkala WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_pangkat);

	if ($usul > 0) {
		$_SESSION['pesan'] = '9';
		header('location:../data_pegawai.php');
	} else {
		// SQL Update No HP
		if ($no_hp_lama != $no_hp_baru) {
			$sql = "UPDATE data_pegawai SET no_hp = '$no_hp_baru' WHERE nip = '$nip'";
			$result = mysqli_query($con, $sql);
		};

		// SQL
		$sql = "INSERT INTO `$db_name`.`ajuan_usul_berkala` (`tanggal`, `nip`) VALUES ('$tanggal', '$nip')";
		$result = mysqli_query($con, $sql);

		
		$sql = "INSERT INTO `berkas_ajuan_usul_berkala` (`nip`, `file_path_form`, `file_path_sk_berkala`, `file_path_sk_pangkat`, `file_path_sk_jabatan`) VALUES ('$nip', '$filePath_document_form', '$filePath_document_sk_berkala', '$filePath_document_sk_pangkat', '$filePath_document_sk_jabatan')";
		$result = mysqli_query($con, $sql);
		
		if($result){
			$_SESSION['pesan'] = '1';
			header('location:../data_pegawai.php');
		} else {
			$_SESSION['pesan'] = '1';
			header('location:../data_pegawai.php');
		}
	};	
?>