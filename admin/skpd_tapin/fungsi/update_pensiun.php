<?php 
session_start();
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_spp'])) ||
	(isset($_FILES['document_fc_sk_cpns_pns'])) ||
	(isset($_FILES['document_fc_ktp'])) ||
	(isset($_FILES['document_foto']))
) {
	$fileTmpPath = $_FILES['document_spp']['tmp_name'];
	$fileName = $_FILES['document_spp']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_spp = "document_spp_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_spp = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_spp;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_spp = filePath("document", $document_spp);
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

	

	$fileTmpPath = $_FILES['document_fc_ktp']['tmp_name'];
	$fileName = $_FILES['document_fc_ktp']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_fc_ktp = "document_fc_ktp".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_fc_ktp = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_fc_ktp;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_fc_ktp = filePath("document", $document_fc_ktp);
	}

	$fileTmpPath = $_FILES['document_foto']['tmp_name'];
	$fileName = $_FILES['document_foto']['name'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$document_foto = "document_foto_".md5(time() . $fileName) . '.' . $fileExtension;

	$filePath_document_foto = "";
	$allowedfileExtensions = array('pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$uploadFileDir = buatFolderUpload();
		$dest_path = $uploadFileDir . $document_foto;		
		move_uploaded_file($fileTmpPath, $dest_path);	
		$filePath_document_foto = filePath("document", $document_foto);
	}
}


?>
<?php

	require '../../../db_con/koneksi.php';
	$id = htmlentities(trim( $_POST['id']));
	$tmt_terakhir_jabatan = htmlentities(trim( $_POST['tmt_terakhir_jabatan']));
	$tanggal_pensiun = htmlentities(trim( $_POST['tanggal_pensiun']));
	$kategori_pensiun = htmlentities(trim( $_POST['kategori_pensiun']));

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT * FROM table_pensiun WHERE id = $id");
	$usul = mysqli_num_rows($usul_pangkat);
	$data = mysqli_fetch_assoc($usul_pangkat);

	if (file_exists("../../..".$data['file_path'])) {
		unlink("../../..".$data['file_path']);
	}

	if ($usul == 0) {
        $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Data pegawai tidak valid!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../data_pensiun.php');
	}
	else {
	
	$xx = "";
	if($filePath_document_spp) {
		$xx .= ", file_path_spp = '{$filePath_document_spp}'";
		
		if (file_exists("../../..".$data['file_path_spp'])) {
			unlink("../../..".$data['file_path_spp']);
		}
	}
	if($filePath_document_fc_sk_cpns_pns) {
		$xx .= ", file_path_sk = '{$filePath_document_fc_sk_cpns_pns}'";
		
		if (file_exists("../../..".$data['file_path_sk'])) {
			unlink("../../..".$data['file_path_sk']);
		}
	}
	if($filePath_document_fc_ktp) {
		$xx .= ", file_path_ktp = '{$filePath_document_fc_ktp}'";
		
		if (file_exists("../../..".$data['file_path_ktp'])) {
			unlink("../../..".$data['file_path_ktp']);
		}
	}
	if($filePath_document_foto) {
		$xx .= ", file_path_foto = '{$filePath_document_foto}'";
		
		if (file_exists("../../..".$data['file_path_foto'])) {
			unlink("../../..".$data['file_path_foto']);
		}
	}
	// SQL
	$sql = "UPDATE `table_pensiun` SET `tmt_terakhir_jabatan`='{$tmt_terakhir_jabatan}',`tanggal_pensiun`='{$tanggal_pensiun}',`kategori_pensiun`='{$kategori_pensiun}' {$xx} WHERE `id` = " . $id;
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_pensiun.php');
	}
	else
    $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Pegawai gagal diupdate!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../data_pensiun.php');
	};	
?>