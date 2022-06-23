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
	$newFileName = "usul_berkala_".md5(time() . $fileName) . '.' . $fileExtension;
} else {
	$_SESSION['pesan'] = "Swal.fire({
		icon: 'error',
		title: 'Tidak ada document yang diupload!',
		showConfirmButton: false,
		timer: 1500
	  });";
	header('location:../ajuan_berkala.php');
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
	header('location:../ajuan_berkala.php');
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
		header('location:../ajuan_berkala.php');
		return;
	}

	require '../../../db_con/koneksi.php';

	$nip = htmlentities(trim( $_POST['nip']));
	$no_hp_lama = htmlentities(trim( $_POST['no_hp_lama']));
	$no_hp_baru = htmlentities(trim( $_POST['no_hp_baru']));

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala WHERE nip = $nip");
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
		header('location:../ajuan_berkala.php');
	}
	else {

    if ($no_hp_lama != $no_hp_baru) {
        $sql = "UPDATE data_pegawai SET no_hp = '$no_hp_baru' WHERE nip = '$nip'";
        $result = mysqli_query($con, $sql);
    };

	// SQL
	$sql = "UPDATE `ajuan_usul_berkala` SET file_path = '{$filePath}' WHERE `nip` = " . $nip;
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Pangkat pegawai Berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../ajuan_berkala.php');
	}
	else
    $_SESSION['pesan'] = "Swal.fire({
        icon: 'error',
        title: 'Pangkat pegawai gagal diupdate!',
        showConfirmButton: false,
        timer: 1500
      });";
		header('location:../ajuan_berkala.php');
	};	
?>