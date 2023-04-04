 <?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
			<h1>Manage order</h1>

			<br/><br/>

		<a href="#" class="btn-primary">Add order</a>

		<br><br>

		<?php
		if(isset($_SESSION['no-order-found'])) {
			echo $_SESSION['no-order-found'];
			unset($_SESSION['no-order-found']);
	    }
	    if(isset($_SESSION['update'])) {
			echo $_SESSION['update'];
			unset($_SESSION['update']);
	    }
		?>

		<br/><br/>

		<table class="tbl-full">
			<tr>
				<th>ID</th>
				<th>Food</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
				<th>Date</th>
				<th>Status</th>
				<th>Customer name</th>
				<th>Address</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Actions</th>


			</tr>

			<?php
				$sql = "Select * from `order` order by id desc";
				$res = mysqli_query($connection, $sql);
				if($res) {
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						while ($rows = mysqli_fetch_assoc($res)) {
							$id = $rows['id'];
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
							?>

							<tr>
								<th><?php echo $id ?></th>
								<th><?php echo $food ?></th>
								<th><?php echo $quantity ?></th>
								<th>$<?php echo $price ?></th>
								<th>$<?php echo $total ?></th>
								<th><?php echo $date ?></th>
								<th>
									<?php
										if($status == "Ordered") {
											echo "<label>$status</label>";
										}
										if($status == "On delivery") {
											echo "<label>$status</label>";
										}
										if($status == "Delivered") {
											echo "<label style='color:green'>$status</label>";
										}
										if($status == "Cancelled") {
											echo "<label style='color:red'>$status</label>";
										}

									?>

								</th>
								<th><?php echo $customer_name ?></th>
								<th><?php echo $customer_address ?></th>
								<th><?php echo $customer_email ?></th>
								<th><?php echo $customer_contact ?></th>



								<th>
									<a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
									<a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
								</th>
							</tr>

							<?php
						}
					} else {
						?>

						<tr>
							<td colspan="6">
								<div class="failure">No order</div>
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
