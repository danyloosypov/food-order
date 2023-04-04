<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update food</h1>
		<br><br>

		<?php
		    if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
		    }
		    if(isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
		    }
		?>

		<br><br>

		<?php
			if(isset($_GET['id'])) {
				$id = $_GET['id'];

				$sql = "Select* from food where id = $id";

				$res = mysqli_query($connection, $sql);

				$count = mysqli_num_rows($res);

				if($count == 1) {
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image'];
					$description = $row['description'];
					$price = $row['price'];
					$current_category = $row['category_id'];
					$featured = $row['featured'];
					$active = $row['active'];
				} else {
					$_SESSION['no-food-found'] = "<div class='failure'> Food not found </div>";
					header("location:".SITEURL.'admin/manage-food.php');
				}
			} else {
				header("location:".SITEURL.'admin/manage-food.php');
			}
		?>



		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>
						Title:
					</td>
					<td>
						<input type="text" name="title" value="<?php echo $title ?>">
					</td>
				</tr>
				<tr>
					<td>
						Description:
					</td>
					<td>
						<textarea name="description" id="" cols="30" rows="10"><?php echo $description ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Price:
					</td>
					<td>
						<input type="number" value="<?php echo $price ?>" name="price">
					</td>
				</tr>
				<tr>
					<td>
						Current image:
					</td>
					<td>
						<?php
							if($current_image != "") {
								?>
								<img src="<?php echo SITEURL ?>images/food/<?php echo $current_image ?>" width="100px" alt="">
								<?php

							} else {
								echo "<div class='failure'>No image </div>";
							}
						 ?>
					</td>
				</tr>
				<tr>
					<td>
						Select image:
					</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>
						Category:
					</td>
					<td>
						<select name="category" id="">
							<?php
								$sql2 = "Select * from category where active = 'Yes'";

								$res2 = mysqli_query($connection, $sql2);

								$count2 = mysqli_num_rows($res2);

								if($count2 > 0) {
									while ($row2 = mysqli_fetch_assoc($res2)) {
										$category_id = $row2['id'];
										$category_title = $row2['title'];
										?>
											<option <?php if($current_category == $category_id) {echo "selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
										<?php
									}
								} else {

									?>
									<option value="0">No category</option>
									<?php
								}

							?>

						</select>
					</td>
				</tr>
				<tr>
					<td>
						Featured:
					</td>
					<td>
						<input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
						<input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>

				</tr>
				<tr>
					<td>
						Active
					</td>
					<td>
						<input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						<input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="current_image" value="<?php echo $current_image ?>">
							<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="submit" name="submit" value="Update food" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>


		<?php

		if(isset($_POST['submit'])) {
			$id = $_POST['id'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$current_image = $_POST['current_image'];
			$category = $_POST['category'];
			$featured = $_POST['featured'];
			$active = $_POST['active'];

			if(isset($_FILES['image']['name'])) {
				$image_name = $_FILES['image']['name'];

				if($image_name!="") {
					$ext = end(explode('.', $image_name));

					$image_name = "Food_Name_".rand(000, 999).'.'.$ext;



					$source_path = $_FILES['image']['tmp_name'];
					$destination_path = "../images/food/" . $image_name;

					$upload = move_uploaded_file($source_path, $destination_path);

					if(!$upload){
						$_SESSION['upload'] = "<div class='failure'> Failed to upload </div>";
						header("location:".SITEURL.'admin/manage-food.php');
						die();
					}

					if($current_image != "") {
						$remove_path = "../images/food/".$current_image;

						$remove = unlink($remove_path);

						if($remove == false) {
							$_SESSION['failed-remove'] = "<div class='failure'> Failed to remove image </div>";
							header('location:'.SITEURL.'admin/manage-food.php');
							die();
						}
					}



				} else {
					$image_name = $current_image;
				}
			} else {
				$image_name = $current_image;
			}



			$sql3 = "Update food set title = '$title', description = '$description', price = $price, category_id = $category, image = '$image_name', featured = '$featured', active = '$active' where id = $id";

			$res3 = mysqli_query($connection, $sql3);

			if($res3) {
				$_SESSION['update'] = "<div class='success'> Updated successfully </div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			} else {
				$_SESSION['update'] = "<div class='failure'> Failed to update </div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			}



		}



		?>



	</div>
</div>

<?php include('../partials/footer.php') ?>

