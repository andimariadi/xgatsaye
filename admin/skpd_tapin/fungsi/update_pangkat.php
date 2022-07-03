<?php 
session_start();
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_sk_kenaikan_pangkat_terakhir'])) ||
	(isset($_FILES['document_fc_sk_cpns_pns'])) ||
	(isset($_FILES['document_fc_skp'])) ||
	(isset($_FILES['document_fc_kp']))
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
	}
	
}



?>
<?php

	require '../../../db_con/koneksi.php';
	$id = htmlentities(trim( $_POST['id']));
	$golongan_pangkat_tujuan = strtoupper( htmlentities(trim( $_POST['golongan_pangkat_tujuan'])) );

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT * FROM table_pangkat WHERE id = $id");
	$usul = mysqli_num_rows($usul_pangkat);

	$data = mysqli_fetch_assoc($usul_pangkat);

	if ($usul == 0) {
        $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Data pegawai tidak valid!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../data_pangkat.php');
	}
	else {

	$xx = "";
	if($filePath_document_sk_kenaikan_pangkat_terakhir) {
		$xx .= ", file_path_sk_kenaikan_pangkat_terakhir = '{$filePath_document_sk_kenaikan_pangkat_terakhir}'";

		if (file_exists("../../..".$data['file_path_sk_kenaikan_pangkat_terakhir'])) {
			unlink("../../..".$data['file_path_sk_kenaikan_pangkat_terakhir']);
		}
	}
	if($filePath_document_fc_sk_cpns_pns) {
		$xx .= ", file_path_fc_sk_cpns_pns = '{$filePath_document_fc_sk_cpns_pns}'";
		

		if (file_exists("../../..".$data['file_path_fc_sk_cpns_pns'])) {
			unlink("../../..".$data['file_path_fc_sk_cpns_pns']);
		}
	}
	if($filePath_document_fc_skp) {
		$xx .= ", file_path_fc_skp = '{$filePath_document_fc_skp}'";
		

		if (file_exists("../../..".$data['file_path_fc_skp'])) {
			unlink("../../..".$data['file_path_fc_skp']);
		}
	}
	if($filePath_document_fc_kp) {
		$xx .= ", file_path_fc_kp = '{$filePath_document_fc_kp}'";
		

		if (file_exists("../../..".$data['file_path_fc_kp'])) {
			unlink("../../..".$data['file_path_fc_kp']);
		}
	}
	// SQL
	$sql = "UPDATE `table_pangkat` SET `golongan_pangkat_tujuan`='{$golongan_pangkat_tujuan}' {$xx} WHERE `id` = " . $id;
	
	echo $sql;
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pangkat pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_pangkat.php');
	}
	else
    $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Pangkat pegawai gagal diupdate!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../data_pangkat.php');
	};	
?>