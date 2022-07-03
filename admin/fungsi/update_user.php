<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';

    
	$username       = htmlentities(trim( $_POST['username'] ));
	$nama           = htmlentities(trim( $_POST['nama'] ));
	$skpd           = htmlentities(trim( $_POST['skpd'] ));
	$email          = htmlentities(trim( $_POST['email'] ));
	$level          = htmlentities(trim( $_POST['level'] ));

    $checkUsername = mysqli_query($con, "SELECT * FROM `verifikator_berkala` WHERE username = '{$username}'");
    if (mysqli_num_rows($checkUsername) == 0) {
        $_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Username tidak ditemukan.',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_user.php');
        return;
    }
	
	$sql = "UPDATE `verifikator_berkala` SET `nama`='{$nama}',`level`='{$level}',`skpd`='{$skpd}',`email`='{$email}' WHERE `username` = '{$username}';";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Data pengguna berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
          });";
		header('location:../data_user.php');
	} else {
		$_SESSION['pesan'] = "Swal.fire({
			icon: 'error',
			title: 'Gagal update data!',
			showConfirmButton: false,
			timer: 1500
		});";
		header('location:../data_user.php');
    }

?>

