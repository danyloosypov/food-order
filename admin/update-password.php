<?php
	include('../partials/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change password</h1>
		<br><br>

		<?php
            if (isset($_GET['id'])) {
            	$id = $_GET['id'];
            }


		?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>
						Current password:
					</td>
					<td>
						<input type="password" name="current_password" placeholder="Current password">
					</td>
				</tr>

				<tr>
					<td>
						New password:
					</td>
					<td>
						<input type="password" name="new_password" placeholder="New password">
					</td>
				</tr>

				<tr>
					<td>
						Confirm password:
					</td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="submit" class="btn-secondary" name="submit" value="Change password">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>


<?php
	if(isset($_POST['submit'])) {

		$id = $_POST['id'];
		$current_password = md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);

		$sql = "Select * from user where id = " . $id . " and password = '" . $current_password . "'";
		$res = mysqli_query($connection, $sql);

		if ($res) {
			$count = mysqli_num_rows($res);

			if($count == 1) {
				if ($new_password == $confirm_password){
					$sql2 = "Update user set password = '" . $new_password . "' where id = " . $id;

					$res2 = mysqli_query($connection, $sql2);

					if($res2) {
						$_SESSION['change-pwd'] = "<div class='success'>Changed</div>";
						header("location:".SITEURL.'admin/manage-admin.php');
					} else {
						$_SESSION['change-pwd'] = "<div class='failure'>Failed to change</div>";
						header("location:".SITEURL.'admin/manage-admin.php');
					}
				} else {
					$_SESSION['pwd-not-match'] = "<div class='failure'>Failed to update</div>";
					header("location:".SITEURL.'admin/manage-admin.php');
				}
			} else {
				$_SESSION['user-not-found'] = "<div class='failure'>User Not Found</div>";
				header("location:".SITEURL.'admin/manage-admin.php');
			}
		}
		else
		{
			echo "no res";
		}
	}
?>


<?php
	include('../partials/footer.php');
?>