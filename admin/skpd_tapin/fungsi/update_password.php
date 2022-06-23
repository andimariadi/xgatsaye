<?php
	require '../../../db_con/koneksi.php';

	$username = $_POST['username'];

	$password_lama = $_POST['password_lama'];
	$password_baru = $_POST['password_baru'];
	$konfirmasi_password = $_POST['konfirmasi_password'];

	$result = mysqli_query($con, "SELECT * FROM verifikator_berkala WHERE username = '$username'");
	$row=mysqli_fetch_array($result);

	if ($password_baru == $konfirmasi_password) {
		if ($password_lama == $row["password"]) {
			mysqli_query($con,"UPDATE verifikator_berkala SET password = '$password_baru' WHERE username = '$username' ");
			echo "<script>alert('Password Berhasil di Update, Silahkan Login Kembali');document.location='../../../index.php'</script>";
			session_start();
			session_destroy();
			}echo "<script>alert('Password Gagal di Update');document.location='../../../index.php'</script>";
	} echo "<script>alert('Cek Kembali Konfirmasi Password');document.location='../../../index.php'</script>";
?>