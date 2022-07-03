<?php 
session_start();
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_form'])) ||
	(isset($_FILES['document_sk_berkala'])) ||
	(isset($_FILES['document_sk_pangkat'])) ||
	(isset($_FILES['document_sk_jabatan']))
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
	}
}

?>
<?php

	require '../../../db_con/koneksi.php';

	$nip = htmlentities(trim( $_POST['nip']));
	$no_hp_lama = htmlentities(trim( $_POST['no_hp_lama']));
	$no_hp_baru = htmlentities(trim( $_POST['no_hp_baru']));

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_pangkat);

	$berkas_pangkat = mysqli_query($con,"SELECT * FROM berkas_ajuan_usul_berkala WHERE nip = $nip");

	$data = mysqli_fetch_assoc($berkas_pangkat);

	if ($usul == 0) {
        $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Data pegawai tidak valid!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../ajuan_berkala.php');
	}

    if ($no_hp_lama != $no_hp_baru) {
        $sql = "UPDATE data_pegawai SET no_hp = '$no_hp_baru' WHERE nip = '$nip'";
        $result = mysqli_query($con, $sql);
    };



	$xx = "";
	if($filePath_document_form) {
		$xx .= ", file_path_form = '{$filePath_document_form}'";

		if (file_exists("../../..".$data['file_path_form'])) {
			unlink("../../..".$data['file_path_form']);
		}
	}
	if($filePath_document_sk_berkala) {
		$xx .= ", file_path_sk_berkala = '{$filePath_document_sk_berkala}'";
		

		if (file_exists("../../..".$data['file_path_sk_berkala'])) {
			unlink("../../..".$data['file_path_sk_berkala']);
		}
	}
	if($filePath_document_sk_pangkat) {
		$xx .= ", file_path_sk_pangkat = '{$filePath_document_sk_pangkat}'";
		

		if (file_exists("../../..".$data['file_path_sk_pangkat'])) {
			unlink("../../..".$data['file_path_sk_pangkat']);
		}
	}
	if($filePath_document_sk_jabatan) {
		$xx .= ", file_path_sk_jabatan = '{$filePath_document_sk_jabatan}'";
		

		if (file_exists("../../..".$data['file_path_sk_jabatan'])) {
			unlink("../../..".$data['file_path_sk_jabatan']);
		}
	}
	// SQL
	$sql = "UPDATE `berkas_ajuan_usul_berkala` SET `nip` = '{$nip}' {$xx} WHERE `nip` = " . $nip;
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pangkat pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../ajuan_berkala.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Pangkat pegawai gagal diupdate!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../ajuan_berkala.php');
	}
?>