<?php include('../partials/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>DASHBOARD</h1>
		<br>
			<?php
				if(isset($_SESSION['login'])){
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}
			?>
		<br>



		<div class="col-4 text-center">
			<?php
				$sql = "Select * from category";

				$res = mysqli_query($connection, $sql);

				$count = mysqli_num_rows($res);
			?>
			<h1><?php echo $count ?></h1>
			<br/>
			Categories
		</div>
		<div class="col-4 text-center">
			<?php
				$sql1 = "Select * from food";

				$res1 = mysqli_query($connection, $sql1);

				$count1 = mysqli_num_rows($res1);
			?>
			<h1><?php echo $count1 ?></h1>
			<br/>
			Foods
		</div>
		<div class="col-4 text-center">
			<?php
				$sql2 = "Select * from `order`";

				$res2 = mysqli_query($connection, $sql2);

				$count2 = mysqli_num_rows($res2);
			?>
			<h1><?php echo $count1 ?></h1>
			<br/>
			Orders
		</div>
		<div class="col-4 text-center">
			<?php
				$sql3 = "Select sum(total) as total from `order` where status = 'Delivered'";

				$res3 = mysqli_query($connection, $sql3);

				$row3 = mysqli_fetch_assoc($res3);

				$revenue = $row3['total'];

			?>
			<h1>$<?php echo $revenue ?></h1>
			<br/>
			Revenue
		</div>

		<div class="clearfix"></div>

	</div>
</div>

<?php include('../partials/footer.php') ?>

