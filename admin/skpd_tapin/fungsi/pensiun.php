<?php 
session_start();
 
include 'buat_folder.php';
if($_SESSION['level'] !="skpd"){
    header("location:../index.php");
}
if (
	(isset($_FILES['document_spp']) && $_FILES['document_spp']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_fc_sk_cpns_pns']) && $_FILES['document_fc_sk_cpns_pns']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_fc_ktp']) && $_FILES['document_fc_ktp']['error'] === UPLOAD_ERR_OK) ||
	(isset($_FILES['document_foto']) && $_FILES['document_foto']['error'] === UPLOAD_ERR_OK)
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
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Surat Permohonan Pensiun tidak valid!',
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
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Fotocopy KTP tidak valid!',
			showConfirmButton: false,
			timer: 1500
		  });";
		header('location:../data_pegawai.php');
		return;
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
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Document Fotocopy KTP tidak valid!',
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
		$filePath_document_spp == "" ||
		$filePath_document_fc_sk_cpns_pns == "" ||
		$filePath_document_fc_ktp == "" ||
		$filePath_document_foto == ""
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
	$to_subject = 'Informasi: Pembuatan Data Pensiun baru';
	$to_body = 'Hi Admin, kami menginformasikan bahwa ada penginputan data pensiun dari SKPD dan harus memberikan approval dari Anda. Segera lihat admin panel untuk melakukan aproval.';

	require '../../../plugins/kirim.php';


	$nip = htmlentities(trim( $_POST['nip']));
	$tmt_terakhir_jabatan = htmlentities(trim( $_POST['tmt_terakhir_jabatan']));
	$tanggal_pensiun = htmlentities(trim( $_POST['tanggal_pensiun']));
	$kategori_pensiun = htmlentities(trim( $_POST['kategori_pensiun']));

	// Cek Usul Pangkat
	$usul_pangkat = mysqli_query($con,"SELECT nip FROM table_pensiun WHERE nip = $nip");
	$usul = mysqli_num_rows($usul_pangkat);

	if ($usul > 0) {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Data pegawai sudah diajukan!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pegawai.php');
	}
	else {

	// SQL
	$sql = "INSERT INTO `$db_name`.`table_pensiun` (`nip`, `tmt_terakhir_jabatan`, `tanggal_pensiun`, `kategori_pensiun`, `file_path_spp`, `file_path_sk`, `file_path_ktp`, `file_path_foto`) VALUES ('$nip', '$tmt_terakhir_jabatan','$tanggal_pensiun', '$kategori_pensiun', '$filePath_document_spp', '$filePath_document_fc_sk_cpns_pns', '$filePath_document_fc_ktp', '$filePath_document_foto')";
		
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['msg'] = "Swal.fire({
			icon: 'success',
			title: 'Data pensiun berhasil ditambahkan!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_pegawai.php');
	}
	else
	$_SESSION['msg'] = "Swal.fire({
		icon: 'error',
		title: 'Error! operation tidak valid!',
		showConfirmButton: false,
		timer: 1500
	});";
		header('location:../data_pegawai.php');
	};	
?>