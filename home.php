<?php
session_start();
if(isset($_SESSION['customer_ID'])){
  include 'partials/cheader.php';
} else{
  include 'partials/header.php';
}

//fetch post
$query = "SELECT * FROM vehicle ORDER BY VehicleID DESC";
$vehicles = mysqli_query($connection, $query);
?>


<section class="home" id="home">
  <div class="home-text">
    <h1>  
      <span>Looking</span> to <span>rent</span> <br>  a <span>car</span></h1>
    <p>PRC, your gateway to hassle-free, convenient, and reliable car rentals. <br> Explore our diverse fleet, find the perfect vehicle for your needs, 
      and <br> book with confidence. Your journey begins here.</p>

      <button class="home-btn" >
        <a class="home-rent" href="signin.php">Discover Now</a>
      </button>
  </div>
  
  <div class="car0-container">
    <img class="car0" src="images/clogo.png">
  </div>
</section>


  <!--===========================ABOUT==================================-->

  <section class="about-container" id="home-about">
  <h2 class="about-heading">About Us</h2>
  <p class="about-subheading">Panan makes exploring Siargao easy with reliable rentals and excellent service.</p>
  <div class="about-boxes">
    <div class="about-box">
      <img src="images/logo/who.png" alt="Who We Are Icon" class="about-icon">
      <h2>Who We Are</h2>
      <p>Panan is your trusted car rental service on Siargao Island, founded by the esteemed Puno family. With a legacy of successful businesses in Davao City and Siargao, we are dedicated to providing reliable and high-quality rental vehicles.</p>
    </div>
    <div class="about-box">
      <img src="images/logo/offer.png" alt="What We Offer Icon" class="about-icon">
      <h2>What We Offer</h2>
      <p>We provide a range of well-maintained vehicles suited for solo travelers, families, and groups. Our rentals are designed to handle Siargao’s diverse terrains, ensuring a smooth and comfortable journey.</p>
    </div>
    <div class="about-box">
      <img src="images/logo/commitment.png" alt="Our Commitment Icon" class="about-icon">
      <h2>Our Commitment</h2>
      <p>At Panan, we prioritize convenience, safety, and exceptional service. Our goal is to enhance your Siargao adventure by offering hassle-free rentals and a seamless travel experience.</p>
    </div>
  </div>
</section>

  <!--===========================SERVICES==================================-->
<!-- =========================== SERVICES ================================ -->
<section class="home-services" id="home-services">
    <h2 class="header">BEST SERVICES</h2>
    <p class="top-text subheading">Explore Siargao effortlessly with our well-maintained and reliable rental vehicles, perfect for every adventure.</p>

    <!-- ========================= CATEGORY BUTTONS ========================= -->
    <section class="category_buttons">
        <div class="container category_buttons-container">
            <?php
            $all_categories_query = "SELECT * FROM category";
            $all_categories = mysqli_query($connection, $all_categories_query); 
            while ($category = mysqli_fetch_assoc($all_categories)) :
            ?>
                <a href="<?= ROOT_URL ?>category-posts.php?categoryID=<?= $category['CategoryID'] ?>" class="category_button">
                    <?= htmlspecialchars($category['VehicleType']) ?>
                </a>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- ========================= END CATEGORY BUTTONS ========================= -->

    <div class="container posts_container">
        <?php while ($vehicle = mysqli_fetch_assoc($vehicles)) : ?>
            <article class="post">
                <div class="post_thumbnail">
                    <img class="thumbnail_img" src="./images/<?= htmlspecialchars($vehicle['vImage']) ?>" alt="Vehicle Image">
                </div>
                <div class="post_info">
                    <?php
                    // Fetch category details once per vehicle
                    $CategoryID = $vehicle['CategoryID'];
                    $category_query = "SELECT VehicleType FROM category WHERE CategoryID = $CategoryID";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    
                    <a href="<?= ROOT_URL ?>category-posts.php?CategoryID=<?= $vehicle['CategoryID']?>" class="category_button">
                        <?= htmlspecialchars($category['VehicleType']) ?>
                    </a>

                    <h3 class="post_title">
                        <a href="post.php">
                            <?= htmlspecialchars($vehicle['vBrand']) ?> 
                            <span style="color: red;"><?= htmlspecialchars($vehicle['vModel']) ?></span>
                        </a>
                    </h3>

                    <p class="RatePerDay">&#8369;<?= number_format($vehicle['RatePerDay']) ?> / Day</p>
                    <p class="vPLNo"><?= htmlspecialchars($vehicle['vPLNo']) ?></p>
                    <p class="Availability"><?= htmlspecialchars($vehicle['Availability']) ?></p>

                    <a href="vehicle.php?vID=<?= urlencode($vehicle['VehicleID']); ?>">
                        <button id="rent-btn" class="rent-btn">Rent Now</button>
                    </a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</section>
<!-- =========================== END SERVICES ================================ -->


  <!--=======================CONTACT====================-->
  <section class="home-contact" id="home-contact">
    <h2>GET IN TOUCH</h2>

  <div class="contact-info">
    <div class="info-item">
      <img src="" alt="">
      <h2>Location</h2>
      <p>General Luna, Siargao <br> Del Norte, Philippines</p>
    </div>

    <div class="info-item">
      <img src="" alt="">
      <h2>Phone</h2>
      <p>+63 977 272 5054<br>(082) 297-1235</p>
    </div>

    <div class="info-item">
      <img src="" alt="">
      <h2>Email</h2>
      <p>PanAn@gmail.com</p>
    </div>
 </div>
    

  <div class="contact-container">
    <form action="https://formsubmit.co/samanthagwyneth15@gmail.com" method="POST">
        <input type="text" name="Name" placeholder="Full Name" required>
        <input type="email" name="Email" placeholder="Email" required>
        <textarea name="Message" placeholder="Message" required></textarea>
        <button type="submit" class="btn">Send</button>
    </form>
  </div>
</section>

<?php
include 'partials/footer.php';
?>

