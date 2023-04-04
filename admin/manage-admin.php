<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage admin</h1>

		<br/>

		<?php
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			if(isset($_SESSION['delete'])) {
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}

			if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}

			if(isset($_SESSION['user-not-found'])) {
				echo $_SESSION['user-not-found'];
				unset($_SESSION['user-not-found']);
			}

			if(isset($_SESSION['pwd-not-match'])) {
				echo $_SESSION['pwd-not-match'];
				unset($_SESSION['pwd-not-match']);
			}

			if(isset($_SESSION['change-pwd'])) {
				echo $_SESSION['change-pwd'];
				unset($_SESSION['change-pwd']);
			}
		 ?>

		 <br/><br/>

		<a href="add-admin.php" class="btn-primary">Add admin</a>

		<br/><br/>

		<table class="tbl-full">
			<tr>
				<th>ID</th>
				<th>Full name</th>
				<th>username</th>
				<th>Actions</th>
			</tr>

			<?php
				$sql = "Select * from user";
				$res = mysqli_query($connection, $sql);
				if($res) {
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						while ($rows = mysqli_fetch_assoc($res)) {
							$id = $rows['id'];
							$full_name = $rows['full_name'];
							$username = $rows['username'];

							?>

							<tr>
								<th><?php echo $id ?></th>
								<th><?php echo $full_name ?></th>
								<th><?php echo $username ?></th>
								<th>
									<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change password</a>
									<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
									<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete</a>
								</th>
							</tr>

							<?php
						}
					}
				}

			?>




		</table>

	</div>
</div>

<?php include('../partials/footer.php') ?>

