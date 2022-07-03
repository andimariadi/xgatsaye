<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}
?>
<?php
	require '../../db_con/koneksi.php';

    $username       = htmlentities(trim( $_POST['username'] ));
	$password       = password_hash( htmlentities(trim( $_POST['password'] )), PASSWORD_DEFAULT);

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
	
	$sql = "UPDATE `verifikator_berkala` SET `password`='{$password}' WHERE `username` = '{$username}';";
	$result = mysqli_query($con, $sql);
	
	if($result){
		$_SESSION['pesan'] = "Swal.fire({
            icon: 'success',
            title: 'Kata sandi berhasil diatur ulang!',
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

