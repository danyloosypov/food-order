<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <br>
        <?php
            if(isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
        ?>
    <br>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "Select * from category where active = 'Yes' and featured = 'Yes' limit 3";

                $res = mysqli_query($connection, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image'];
                        ?>
                            <a href="<?php echo SITEURL ?>category-foods.php?category_id=<?php echo $id ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name == "") {
                                            echo "<div class='failure'>Image is not available</div>";
                                        } else {
                                            ?>
                                    <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                } else {
                    echo "<div class='failure'> Category not found </div>";
                }
            ?>





            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "Select * from food where active = 'Yes' and featured = 'Yes' limit 6";

                $res2 = mysqli_query($connection, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == "") {
                                            echo "<div class='failure'>Image is not available</div>";
                                        } else {
                                            ?>
                                            <img src="<?php SITEURL ?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>


                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title ?></h4>
                                        <p class="food-price">$<?php echo $price ?></p>
                                        <p class="food-detail">
                                            <?php echo $description ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                            </div>
                        <?php
                    }
                } else {
                    echo "<div class='failure'> F00d not found </div>";
                }
            ?>






            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>
