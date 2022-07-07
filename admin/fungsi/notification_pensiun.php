<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';
	
	$nip        = htmlentities(trim( $_POST['nip'] ));
	$nama   	= htmlentities(trim( $_POST['nama'] ));
	$email       = htmlentities(trim( $_POST['email'] ));
	$kategori_pensiun = htmlentities(trim( $_POST['kategori_pensiun'] ));
	$message     = htmlentities(trim( $_POST['message'] ));
	
	$to_email = $email;
	$to_nama = $nama;
	$to_subject = 'Informasi: Pengajuan Pensiun pegawai';
	$to_body = $message;

	require '../../plugins/kirim.php';
	
	$sql = "INSERT INTO `notifikasi_pensiun`(`id`, `nip`, `nama`, `email`, `kategori_pensiun`, `message`) VALUES (NULL,'{$nip}','{$nama}','{$email}','{$kategori_pensiun}','{$message}')";
	$result = mysqli_query($con, $sql);
	

	if($result){
		$_SESSION['msg'] = "Swal.fire({
            icon: 'success',
            title: 'Pesan anda telah terkirim!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../notification_pensiun.php');
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal mengirimkan pesan!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../notification_pensiun.php');
    }

?>

