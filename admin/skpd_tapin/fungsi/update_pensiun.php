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
	$_SESSION['pesan'] = "Swal.fire({
		icon: 'error',
		title: 'Tidak ada document yang diupload!',
		showConfirmButton: false,
		timer: 1500
	  });";
	header('location:../data_pensiun.php');
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
	$_SESSION['pesan'] = "Swal.fire({
		icon: 'error',
		title: 'Document tidak valid!',
		showConfirmButton: false,
		timer: 1500
	  });";
	header('location:../data_pensiun.php');
	return;
}

?>
<?php
	if($filePath == "") {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Tidak ada document yang diupload!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pensiun.php');
		return;
	}

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

	// SQL
	$sql = "UPDATE `table_pensiun` SET `tmt_terakhir_jabatan`='{$tmt_terakhir_jabatan}',`tanggal_pensiun`='{$tanggal_pensiun}',`kategori_pensiun`='{$kategori_pensiun}', file_path = '{$filePath}' WHERE `id` = " . $id;
		
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