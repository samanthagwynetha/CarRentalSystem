<?php
session_start();
if(isset($_SESSION['customer_ID'])){
  header("Location: index.php");
}
if(isset($_SESSION['admin_ID'])){
  header('location: '. ROOT_URL .'admin/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental Website</title>

  <!--Style-->
  <link rel="stylesheet" href="css/signin.css">
    <!--Icon-->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <!--FONTS-->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;800&family=Playfair:wght@300&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <section class="form_section">
    <div class="container form_section-container">
    <h2>Sign In</h2>
    <form action="signin.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="signin-email" placeholder="Username or Email">
      <input type="password" name="signin-password" placeholder="Password">   
      <button type="submit" name="sign-in-btn" class="btn">Sign In</button>
      <small>Don't have an account?<a href="signup.php">Sign Up</a></small>
    </form>
  </section>
  
</body>
</html>


<?php
    require 'config/database.php';
    if(isset($_POST['sign-in-btn'])){
    $errors = array();

      // Validate email
      if(empty($_POST['signin-email'])){
          $errors[] = "Email is required";
      } else {
          $email = trim($_POST['signin-email']);
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
              $errors[] = "Invalid email format";
          }
      }

      // Validate password
      if(empty($_POST['signin-password'])){
          $errors[] = "Password is required";
      } else {
          $password = trim($_POST['signin-password']);
          // You can add additional password validation checks here if needed
      }

      // If there are no errors, proceed with authentication
      if(empty($errors)){
        $InEmail=trim($_POST['signin-email']);
        $InPassword=trim($_POST['signin-password']);

        $sql="SELECT*FROM customer WHERE cEmail='$InEmail'";
        $result = mysqli_query($connection, $sql);
        $customer = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $sql="SELECT*FROM `admin` WHERE aEmail='$InEmail'";
        $result = mysqli_query($connection, $sql);
        $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($customer) {
          // Customer email found in database
          if ($InPassword == $customer['cPassword']) {
            // Password matches, start session and redirect
            session_start();
            $_SESSION['customer_ID'] = $customer['CustomerID'];
            header('location: '. ROOT_URL .'index.php');
            die();
          } else {
            // Password does not match for customer
            echo '<script>alert("Password does not match");</script>';
          }
        } elseif ($admin) {
          // Admin email found in database
          if ($InPassword == $admin['aPassword']) {
            // Password matches, start session and redirect
            session_start();
            $_SESSION['admin_ID'] = $admin['AdminID'];
            header('location: '. ROOT_URL .'admin/index.php');
            die();
          } else {
            // Password does not match for admin
            echo '<script>alert("Password does not match");</script>';
          }
        } else {
          // Email does not exist in database for both customer and admin
          echo '<script>alert("Email does not exist");</script>';
        }

      } else {
          // Display validation errors
          foreach($errors as $error){
              echo '<script>alert("'.$error.'");</script>';
          }
      }
}
