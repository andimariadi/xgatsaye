<?php
	$host = 'localhost';
    $username = 'root';
	$password = '';
	$db_name = 'berkala_bkd';

	$con = mysqli_connect($host, $username, $password, $db_name);

	function base_url($path = "")
	{
		return 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] . "/berkala_bkd" . $path;
	}
?>