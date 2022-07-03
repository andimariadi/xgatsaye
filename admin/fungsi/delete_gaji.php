<?php 
session_start();
 
if($_SESSION['level'] !="admin"){
    header("location:../index.php");
}

include '../../db_con/koneksi.php';
$id = htmlentities(trim( $_POST['id']));
// SQL
$sql = "DELETE FROM `table_gajih` WHERE `id` = " . $id;
    
$result = mysqli_query($con, $sql);
?>