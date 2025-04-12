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
       Looking to rent <br>  a <span>car</span></h1>
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

<!-- =========================== SERVICES ================================ -->
<section class="home-services" id="home-services">
    <h2 class="header">BEST SERVICES</h2>
    <p class="top-text subheading">Explore Siargao effortlessly with our well-maintained and reliable rental vehicles, perfect for every adventure.</p>
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
</div>
</section>
<!-- =========================== END SERVICES ================================ -->


  <!--=======================CONTACT====================-->
  <section class="contact-section" id="contact">
    <div class="container">
        <h2 class="contact-heading">Contact <span>Us</span></h2>
        <p class="contact-description">
        Explore Siargao with ease let us help you find the <br> perfect ride for your island adventure!
        </p>
        <div class="contact-content">
            <div class="contact-detail">
                <h3>Contact detail</h3>
                <p>Have questions or need assistance? Our team is here to help you with bookings, inquiries, and support.</p>
                <ul>
                    <li>
                        <i class="uil uil-phone"></i>
                        +63 977 272 5054
                    </li>
                    <li>
                        <i class="uil uil-envelope"></i>
                        pananr@gmail.com
                    </li>
                    <li>
                        <i class="uil uil-map-marker"></i>
                        General Luna, Siargao, Del Norte, Philippines
                    </li>
                </ul>
            </div>
            <div class="contact-form">
                <form action="https://formsubmit.co/uunaaah@gmail.com" method="POST">
                    <div class="form-group">
                        <input type="text" name="Name" placeholder="Name" required>
                        <input type="email" name="Email" placeholder="Email" required>
                    </div>
                    <input type="text" name="Subject" placeholder="Subject" required>
                    <textarea name="Message" placeholder="Message" required></textarea>
                    <button type="submit" class="btn">Send Now</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php';
?>

