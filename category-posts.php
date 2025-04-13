<?php
include 'partials/header.php';

//fetch posts if id is set
if (isset($_GET['CategoryID'])) {
    $Category_ID = filter_var($_GET['CategoryID'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM vehicle WHERE CategoryID = $Category_ID";
    $vehicles = mysqli_query($connection, $query);

} else {
    header('location: ' . ROOT_URL . 'home.php');
    die();
}
?>

<header class="category_title">
<h2>
  <?php 
        //fetch category from categorues table usin
        $CategoryID = $Category_ID;
        $category_query = "SELECT * FROM category WHERE CategoryID=$Category_ID";
        $category_result = mysqli_query($connection, $category_query);
        $category = mysqli_fetch_assoc($category_result); 
        echo $category['VehicleType'];   
    ?>
  </h2>
  <span>
    <p>
    <?php 
       echo $category['VDescription'];   
    ?>
    </p>
  </span>
</header>
  <!--===========================SERVICES==================================-->
  <section class="posts">
  <div class="container posts_container">
    <?php while ($vehicle = mysqli_fetch_assoc($vehicles)) : ?>
        <article class="post">
            <div class="post_thumbnail">
                <img class="thumbnail_img" src="./images/<?= htmlspecialchars($vehicle['vImage']) ?>" alt="Vehicle Image">
            </div>
            <div class="post_info">
                <h3 class="post_title">
                    <a href="post.php">
                        <?= htmlspecialchars($vehicle['vBrand']) ?> 
                        <span style="color: red;"><?= htmlspecialchars($vehicle['vModel']) ?></span>
                    </a>
                </h3>
                <p class="vPLNo"><?= htmlspecialchars($vehicle['vPLNo']) ?></p>
                <p class="Availability"><?= htmlspecialchars($vehicle['Availability']) ?></p>
                <div class="rate-and-rent">
                    <p class="RatePerDay">
                        <span class="rate">&#8369;<?= number_format($vehicle['RatePerDay']) ?></span> / Day
                    </p>
                    <a href="vehicle.php?vID=<?= urlencode($vehicle['VehicleID']); ?>" class="rent-now-link">
                        Rent Now →
                    </a>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</section>

  <!--=======================END OF THE SERVICES====================-->
   <!-- ========================= CATEGORY BUTTONS ========================= -->
   <section class="category_buttons">
    <div class="container category_buttons-container">
        <?php
        // Fetch all categories from the database
        $all_categories_query = "SELECT * FROM category";
        $all_categories = mysqli_query($connection, $all_categories_query);

        while ($category = mysqli_fetch_assoc($all_categories)) :
        ?>
            <!-- Dynamically generate a button for each category -->
            <a href="<?= ROOT_URL ?>category-posts.php?CategoryID=<?= $category['CategoryID'] ?>" class="category_button">
                <?= htmlspecialchars($category['VehicleType']) ?>
            </a>
        <?php endwhile; ?>
    </div>
</section>
    <!-- ========================= END CATEGORY BUTTONS ========================= -->


<?php
include 'partials/footer.php';
?>

