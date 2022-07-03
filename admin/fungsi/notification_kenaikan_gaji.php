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
	$message     = htmlentities(trim( $_POST['message'] ));
	$pangkat     = htmlentities(trim( $_POST['pangkat'] ));
	$masa_pangkat     = htmlentities(trim( $_POST['masa_pangkat'] ));
    $gaji = mysqli_query($con,"SELECT * FROM table_gajih where pangkat = '{$pangkat}' AND masa_jabatan = '{$masa_pangkat}';");
    
	$data = mysqli_fetch_assoc($gaji);

    if(mysqli_num_rows($gaji) == 0) {
        $_SESSION['msg'] = "Swal.fire({
            icon: 'success',
            title: 'Table pangkat tidak ditemukan!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../notification_kenaikan_gaji.php');
    }
	
	$to_email = $email;
	$to_nama = $nama;
	$to_subject = 'Informasi: Pengajuan kenaikan gaji pegawai';
	$to_body = $message;

	require '../../plugins/kirim.php';
	
	$sql = "INSERT INTO notifikasi_naik_gaji(id, nip, nama, email, message, pangkat, masa_jabatan, golongan, gaji_pokok) VALUES (NULL,'{$nip}','{$nama}','{$email}','{$message}','{$pangkat}','{$masa_pangkat}','{$data['golongan']}','{$data['gaji_pokok']}')";
	$result = mysqli_query($con, $sql);
	

	if($result){
		$_SESSION['msg'] = "Swal.fire({
            icon: 'success',
            title: 'Pesan anda telah terkirim!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../notification_kenaikan_gaji.php');
	} else {
		$_SESSION['msg'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal mengirimkan pesan!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../notification_kenaikan_gaji.php');
    }

?>

