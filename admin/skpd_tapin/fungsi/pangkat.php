<?php 
session_start();

include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_sk_kenaikan_pangkat_terakhir']) && $_FILES['document_sk_kenaikan_pangkat_terakhir']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_fc_sk_cpns_pns']) && $_FILES['document_fc_sk_cpns_pns']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_fc_skp']) && $_FILES['document_fc_skp']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_fc_kp']) && $_FILES['document_fc_kp']['error'] === UPLOAD_ERR_OK)
) {
	$fileTmpPath = $_FILES['document_sk_kenaikan_pangkat_terakhir']['tmp_name'];
	$fileName = $_FILES['document_sk_kenaikan_pangkat_terakhir']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_sk_kenaikan_pangkat_terakhir = "document_sk_pangkat_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_sk_kenaikan_pangkat_terakhir = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_sk_kenaikan_pangkat_terakhir;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_sk_kenaikan_pangkat_terakhir = filePath("document", $document_sk_kenaikan_pangkat_terakhir);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document SK Kenaikan Pangkat tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	$fileTmpPath = $_FILES['document_fc_sk_cpns_pns']['tmp_name'];
	$fileName = $_FILES['document_fc_sk_cpns_pns']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_fc_sk_cpns_pns = "document_fc_sk_cpns_pns_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_fc_sk_cpns_pns = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_fc_sk_cpns_pns;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_fc_sk_cpns_pns = filePath("document", $document_fc_sk_cpns_pns);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Fotocopy SK CPNS & PNS tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	

	$fileTmpPath = $_FILES['document_fc_skp']['tmp_name'];
	$fileName = $_FILES['document_fc_skp']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_fc_skp = "document_fc_skp_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_fc_skp = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_fc_skp;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_fc_skp = filePath("document", $document_fc_skp);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Fotocopy SKP tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
	}

	$fileTmpPath = $_FILES['document_fc_kp']['tmp_name'];
	$fileName = $_FILES['document_fc_kp']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_fc_kp = "document_fc_kp_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_fc_kp = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_fc_kp;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_fc_kp = filePath("document", $document_fc_kp);
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Fotocopy Kartu Pegawai tidak valid!',
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
		$filePath_document_sk_kenaikan_pangkat_terakhir == "" ||
		$filePath_document_fc_sk_cpns_pns == "" ||
		$filePath_document_fc_skp == "" ||
		$filePath_document_fc_kp == ""
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
	$to_subject = 'Informasi: Pembuatan Data Pengajuan Pangkat baru';
	$to_body = 'Hi Admin, kami menginformasikan bahwa ada penginputan data pangkat dari SKPD dan harus memberikan approval dari Anda. Segera lihat admin panel untuk melakukan aproval.';

	require '../../../plugins/kirim.php';
	$nip = htmlentities(trim( $_POST['nip']));
	$golongan_pangkat_tujuan = strtoupper( htmlentities(trim( $_POST['golongan_pangkat_tujuan'])) );

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT nip FROM table_pangkat WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_pangkat);

	if ($usul > 0) {
		$_SESSION['pesan'] = '9';
		header('location:../data_pegawai.php');
	}
	else {

	// SQL
	$sql = "INSERT INTO `$db_name`.`table_pangkat`(`nip`, `golongan_pangkat_tujuan`, `file_path_sk_kenaikan_pangkat_terakhir`, `file_path_fc_sk_cpns_pns`, `file_path_fc_skp`, `file_path_fc_kp`) VALUES ('$nip', '$golongan_pangkat_tujuan', '{$filePath_document_sk_kenaikan_pangkat_terakhir}', '{$filePath_document_fc_sk_cpns_pns}', '{$filePath_document_fc_skp}', '{$filePath_document_fc_kp}')";

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