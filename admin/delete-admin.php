<?php
	include('../config/constants.php');



	$id = $_GET['id'];



	$sql = "Delete from user where id = $id";

	$res = mysqli_query($connection, $sql);

	if($res) {
		$_SESSION['delete'] = "<div class='success'>Admin was deleted</div>";
			header("location:".SITEURL.'admin/manage-admin.php');
	} else {
		$_SESSION['delete'] = "<div class='failure'>Failed to delete</div>";
			header("location:".SITEURL.'admin/manage-admin.php');
	}
?>