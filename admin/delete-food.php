<?php include('../config/constants.php') ?>

<?php


	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if($image_name != "") {
			$path = "../images/food/".$image_name;

			$remove = unlink($path);

			if($remove == false) {
				$_SESSION['remove'] = "<div class='failure'> Failed to remove image </div>";
				header("location:".SITEURL.'admin/manage-food.php');
				die();
			}
		}

		$sql = "Delete from food where id = $id";

		$res = mysqli_query($connection, $sql);


		if($res) {
			$_SESSION['delete'] = "<div class='success'>Food was deleted</div>";
			header("location:".SITEURL.'admin/manage-food.php');
		} else {
			$_SESSION['delete'] = "<div class='failure'>Failed to delete</div>";
			header("location:".SITEURL.'admin/manage-food.php');
		}

	} else {
		header("location:".SITEURL.'admin/manage-food.php');
	}



?>
