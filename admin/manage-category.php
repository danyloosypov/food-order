<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
			<h1>Manage category</h1>

			<br/><br/>

			<?php
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
		    }
		    if(isset($_SESSION['remove'])) {
				echo $_SESSION['remove'];
				unset($_SESSION['remove']);
		    }
		    if(isset($_SESSION['delete'])) {
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
		    }
		    if(isset($_SESSION['no-category-found'])) {
				echo $_SESSION['no-category-found'];
				unset($_SESSION['no-category-found']);
		    }
		    if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
		    }
		    if(isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
		    }
		    if(isset($_SESSION['failed-remove'])) {
				echo $_SESSION['failed-remove'];
				unset($_SESSION['failed-remove']);
		    }
		    ?>

		    <br><br>

		<a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add category</a>

		<br/><br/>

		<table class="tbl-full">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

			<?php
				$sql = "Select * from category";
				$res = mysqli_query($connection, $sql);
				if($res) {
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						while ($rows = mysqli_fetch_assoc($res)) {
							$id = $rows['id'];
							$title = $rows['title'];
							$image_name = $rows['image'];
							$featured = $rows['featured'];
							$active = $rows['active'];
							?>

							<tr>
								<th><?php echo $id ?></th>
								<th><?php echo $title ?></th>

								<th>
									<?php
										if($image_name!=""){
											?>
											<img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" width="100px">
											<?php

										} else {
											echo "<div class='failure'>No image</div>";
										}
									?>
								</th>

								<th><?php echo $featured ?></th>
								<th><?php echo $active ?></th>

								<th>
									<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
									<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
								</th>
							</tr>

							<?php
						}
					} else {
						?>

						<tr>
							<td colspan="6">
								<div class="failure">No category</div>
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
