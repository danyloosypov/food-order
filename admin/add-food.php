<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add food</h1>
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



		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>
						Title:
					</td>
					<td>
						<input type="text" name="title" placeholder="Title">
					</td>
				</tr>
				<tr>
					<td>
						Description:
					</td>
					<td>
						<textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Price:
					</td>
					<td>
						<input type="number" name="price">
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
								$sql = "Select * from category where active = 'Yes'";

								$res = mysqli_query($connection, $sql);

								$count = mysqli_num_rows($res);

								if($count > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
										$id = $row['id'];
										$title = $row['title'];
										?>
											<option value="<?php echo $id ?>"><?php echo $title ?></option>
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
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>

				</tr>
				<tr>
					<td>
						Active
					</td>
					<td>
						<input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Add food" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>


		<?php

		if(isset($_POST['submit'])) {
			$title = $_POST['title'];
			$description = $_POST['description'];
			$category_id = $_POST['category'];
			$price = $_POST['price'];

			if(isset($_POST['featured'])){
               $featured = $_POST['featured'];
			} else {
				$featured = "No";
			}
			if(isset($_POST['active'])){
               $active = $_POST['active'];
			} else {
				$active = "No";
			}
			if(isset($_FILES['image']['name'])) {
				$image_name = $_FILES['image']['name'];

				if($image_name != "") {
					$ext = end(explode('.', $image_name));

					$image_name = "Food_Name_".rand(0000, 9999).'.'.$ext;



					$source_path = $_FILES['image']['tmp_name'];
					$destination_path = "../images/food/" . $image_name;

					$upload = move_uploaded_file($source_path, $destination_path);

					if(!$upload){
						$_SESSION['upload'] = "<div class='failure'> Failed to upload </div>";
						header("location:".SITEURL.'admin/add-food.php');
						die();
					}
				}


			} else {
				$image_name = "";

			}

			$sql2 = "Insert into food (title, description, price, image, category_id, featured, active) values ('$title', '$description', $price, '$image_name', $category_id, '$featured', '$active')";

			$res2 = mysqli_query($connection, $sql2);

			if($res2){

				$_SESSION['add-food'] = "<div class='success'>Food added</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
			} else {
                $_SESSION['add-food'] = "<div class='failure'>Failure</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

			}

		}



		?>



	</div>
</div>

<?php include('../partials/footer.php') ?>

