<?php include('../config/constants.php') ?>

<?php
	//if(isset($_GET['[id]']) echo '1';
	//if(isset($_GET['[image]']) echo '2';

	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if($image_name != "") {
			$path = "../images/category/".$image_name;

			$remove = unlink($path);

			if($remove == false) {
				$_SESSION['remove'] = "<div class='failure'> Failed to remove image </div>";
				header("location:".SITEURL.'admin/manage-category.php');
				die();
			}
		}

		$sql = "Delete from category where id = $id";

		$res = mysqli_query($connection, $sql);


		if($res) {
			$_SESSION['delete'] = "<div class='success'>Category was deleted</div>";
			header("location:".SITEURL.'admin/manage-category.php');
		} else {
			$_SESSION['delete'] = "<div class='failure'>Failed to delete</div>";
			header("location:".SITEURL.'admin/manage-category.php');
		}

	} else {
		header("location:".SITEURL.'admin/manage-category.php');
	}



?>
