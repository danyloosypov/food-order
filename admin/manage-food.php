<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage food</h1>

		<br/><br/>



		<a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add food</a>

		<br><br>

		<?php

				if(isset($_SESSION['add-food'])) {

					echo $_SESSION['add-food'];

					unset($_SESSION['add-food']);
		    	}
		    	if(isset($_SESSION['delete'])) {

					echo $_SESSION['delete'];

					unset($_SESSION['delete']);
		    	}
		    	if(isset($_SESSION['upload'])) {

					echo $_SESSION['upload'];

					unset($_SESSION['upload']);
		    	}
		    	if(isset($_SESSION['remove'])) {

					echo $_SESSION['remove'];

					unset($_SESSION['remove']);
		    	}
		    	if(isset($_SESSION['update'])) {

					echo $_SESSION['update'];

					unset($_SESSION['update']);
		    	}
		    	if(isset($_SESSION['no-food-found'])) {
					echo $_SESSION['no-food-found'];
					unset($_SESSION['no-food-found']);
		    	}
		    	if(isset($_SESSION['failed-remove'])) {
					echo $_SESSION['failed-remove'];
					unset($_SESSION['failed-remove']);
		    	}
			?>

		<br/><br/>

		<table class="tbl-full">
			<tr>
				<th>Id</th>
				<th>Title</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

			<?php
				$sql = "Select * from food";
				$res = mysqli_query($connection, $sql);
				if($res) {
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						while ($rows = mysqli_fetch_assoc($res)) {
							$id = $rows['id'];
							$title = $rows['title'];
							$price = $rows['price'];
							$image_name = $rows['image'];
							$featured = $rows['featured'];
							$active = $rows['active'];
							?>

							<tr>
								<th><?php echo $id ?></th>
								<th><?php echo $title ?></th>
								<th>$<?php echo $price ?></th>


								<th>
									<?php
										if($image_name!=""){
											?>
											<img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" width="100px">
											<?php

										} else {
											echo "<div class='failure'>No image</div>";
										}
									?>
								</th>

								<th><?php echo $featured ?></th>
								<th><?php echo $active ?></th>

								<th>
									<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
									<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
								</th>
							</tr>

							<?php
						}
					} else {
						?>

						<tr>
							<td colspan="6">
								<div class="failure">No food</div>
							</td>
						</tr>

						<?php
					}
				}

			?>


		</table>

	</div>
</div>



<?php include('../partials/footer.php') ?>
