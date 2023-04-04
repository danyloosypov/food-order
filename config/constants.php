<?php

	session_start();
	define('SITEURL', 'http://food-order/');

	$connection = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	$db_select = mysqli_select_db($connection, 'food_order') or die(mysqli_error());
?>