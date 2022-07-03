<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}

include '../../db_con/koneksi.php';
$username = htmlentities(trim( $_POST['username']));
// SQL
$sql = "DELETE FROM `verifikator_berkala` WHERE `username` = '" . $username . "'";
$result = mysqli_query($con, $sql);
?>