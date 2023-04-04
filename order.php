    <?php include('partials-front/menu.php') ?>

    <!-- Navbar Section Ends Here -->

    <?php
        if(isset($_GET['food_id'])) {
            $food_id = $_GET['food_id'];

            $sql = "Select * from food where id = $food_id";

            $res = mysqli_query($connection, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image'];
            } else {
                header('location:'.SITEURL);
            }
        } else {
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name == "") {
                                echo "<div class='failure'> Image is not available </div>";
                            } else {
                                ?>
                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">

                        <p class="food-price">$<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit'])) {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:s");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql2 = "Insert into `order` (food, quantity, price, total, date, status, customer_name, customer_address, customer_email, customer_contact) values
                    ('$food', $qty, $price, $total, '$order_date', '$status', '$customer_name', '$customer_address', '$customer_email', '$customer_contact')";


                    $res2 = mysqli_query($connection, $sql2);

                    if($res2) {
                        $_SESSION['order'] = "<div class='text-center success'>Order proccessed successfully</div>";
                        header("location:".SITEURL);
                    } else {
                        $_SESSION['order'] = "<div class='failure'>Failed to proccess the order</div>";
                        header("location:".SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php include('partials-front/footer.php') ?>
