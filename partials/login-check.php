<?php
	if(!isset($_SESSION['user'])){
		$_SESSION['no-login-message'] = "<div class='text-center failure'>Please login</div>";

		header('location:'.SITEURL.'admin/login.php');


	}
?>