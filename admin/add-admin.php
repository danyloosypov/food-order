<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add admin</h1>
		<br/>

		<?php
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		 ?>

		 <br/>


		<form action="" method="POST" >
			<table class="tbl-30">
				<tr>
					<td>Full name: </td>
					<td><input type="text" name="full_name" placeholder="Full name"></td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="Username"></td>
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" placeholder="Password"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add admin" class="btn-secondary">
					</td>
				</tr>

			</table>
		</form>
	</div>
</div>

<?php include('../partials/footer.php') ?>



<?php
	if (isset($_POST['submit'])) {
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "Insert into user (full_name, username, password) values ('$full_name', '$username', '$password')";



		$res = mysqli_query($connection, $sql)/* or die(mysqli_error())*/;

		if($res) {
			$_SESSION['add'] = "<div class='success'>Admin added</div>";
			header("location:".SITEURL.'admin/manage-admin.php');
		} else {
			$_SESSION['add'] = "<div class='failure'>Failed to add</div>";
			header("location:".SITEURL.'admin/add-admin.php');
		}
	}
 ?>