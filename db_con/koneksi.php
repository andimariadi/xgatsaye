<?php
	$host = 'localhost';
    $username = 'root';
	$password = '';
	$db_name = 'berkala_bkd';

	$con = mysqli_connect($host, $username, $password, $db_name);

	function base_url($path = "")
	{
		return sprintf(
			"%s://%s%s",
			isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME'],
			$_SERVER['REQUEST_URI']
		  ) . "" . $path;
	}
?>