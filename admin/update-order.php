<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update order</h1>
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

				$sql = "Select * from `order` where id = $id";

				$res = mysqli_query($connection, $sql);

				if($res) {
					$count = mysqli_num_rows($res);
					if ($count == 1) {
						$rows = mysqli_fetch_assoc($res);

						$food = $rows['food'];
						$quantity = $rows['quantity'];
						$price = $rows['price'];
						$total = $rows['total'];
						$date = $rows['date'];
						$status = $rows['status'];
						$customer_name = $rows['customer_name'];
						$customer_address = $rows['customer_address'];
						$customer_email = $rows['customer_email'];
						$customer_contact = $rows['customer_contact'];
					}
				} else {
					$_SESSION['no-order-found'] = "<div class='failure'> Order not found </div>";
					header("location:".SITEURL.'admin/manage-order.php');
				}
			} else {
				header("location:".SITEURL.'admin/manage-order.php');
			}
		?>



		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>
						Food:
					</td>
					<td>
						<select name="food" id="">
							<?php
								$sql2 = "Select * from food";

								$res2 = mysqli_query($connection, $sql2);

								$count2 = mysqli_num_rows($res2);

								if($count2 > 0) {
									while ($row2 = mysqli_fetch_assoc($res2)) {
										$food_id = $row2['id'];
										$food_title = $row2['title'];
										?>
											<option <?php if($food == $food_title) {echo "selected";} ?> value="<?php echo $food_id ?>"><?php echo $food_title ?></option>
										<?php
									}
								} else {

									?>
									<option value="0">No category</option>
									<?php
								}
							?>
							<option value=""></option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Quantity:
					</td>
					<td>
						<input type="number" value="<?php echo $quantity ?>" name="quantity">
					</td>
				</tr>
				<tr>
					<td>
						Date:
					</td>
					<td>
						<input type="datetime" value="<?php echo $date ?>" name="date">
					</td>
				</tr>
				<tr>
					<td>
						Status:
					</td>
					<td>
						<select name="status" id="">
							<option <?php if($status == "Ordered") {echo "selected";} ?> value="Ordered">Ordered</option>
							<option <?php if($status == "On delivery") {echo "selected";} ?> value="On delivery">On delivery</option>
							<option <?php if($status == "Delivered") {echo "selected";} ?> value="Delivered">Delivered</option>
							<option <?php if($status == "Cancelled") {echo "selected";} ?> value="Cancelled">Cancelled</option>
						</select>
					</td>

				</tr>
				<tr>
					<td>
						Customer name:
					</td>
					<td>
						<input type="text" value="<?php echo $customer_name ?>" name="customer_name">
					</td>
				</tr>
				<tr>
					<td>
						Customer address:
					</td>
					<td>
						<input value="<?php echo $customer_address ?>" type="text" name="customer_address">
					</td>
				</tr>
				<tr>
					<td>
						Customer email:
					</td>
					<td>
						<input value="<?php echo $customer_email ?>" type="text" name="customer_email">
					</td>
				</tr>
				<tr>
					<td>
						Customer contact:
					</td>
					<td>
						<input type="text" value="<?php echo $customer_contact ?>" name="customer_contact">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Update" class="btn-secondary">
						<input type="hidden" name="id" value="<?php echo $id ?>">
					</td>
				</tr>

			</table>

		</form>

		<?php
			if(isset($_POST['submit'])) {
				$id = $_POST['id'];
				$food_id = $_POST['food'];
				$sql4 = "Select title from food where id = $food_id";
				$res4 = mysqli_query($connection, $sql4);
				$row4 = mysqli_fetch_assoc($res4);

				$food = $row4['title'];

				$quantity = $_POST['quantity'];

				$sql5 = "Select price from food where id = $food_id";
				$res5 = mysqli_query($connection, $sql5);
				$row5 = mysqli_fetch_assoc($res5);
				$price = $row5['price'];

				$total = $price * $quantity;
				$date = $_POST['date'];

				$status = $_POST['status'];
				$customer_name = $_POST['customer_name'];
				$customer_address = $_POST['customer_address'];
				$customer_email = $_POST['customer_email'];
				$customer_contact = $_POST['customer_contact'];

				$sql6 = "Update `order` set food = '$food', quantity = $quantity, price = $price, total = $total, date = '$date', status = '$status', customer_name = '$customer_name', customer_address = '$customer_address', customer_email = '$customer_email', customer_contact = '$customer_contact' where id = $id";



				$res6 = mysqli_query($connection, $sql6);

				if ($res6) {
					$_SESSION['update'] = "<div class='success'>Order was updated</div>";
					header("location:".SITEURL.'admin/manage-order.php');
				} else {
					$_SESSION['delete'] = "<div class='failure'>Failed to update</div>";
					header("location:".SITEURL.'admin/manage-order.php');
				}
			}
		?>




	</div>
</div>

<?php include('../partials/footer.php') ?>

