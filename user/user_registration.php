<?php
session_start();
if(isset($_SESSION['user_id'])){
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Grande Sports Center</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
    
  <!-- Add Tailwind CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    footer {
      margin-top: auto;
    }
    .navbar-brand {
    display: flex;
    align-items: center;
  }

  .navbar-brand img {
    margin-right: 10px;
  }

  .custom_nav-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  </style>
  <script>
function validateForm() {
  var firstName = document.getElementById("first_name").value;
  var lastName = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;
  var phone = document.getElementById("phone").value;
  var gender = document.querySelector('input[name="gender"]:checked');
  
  if (firstName == "" || lastName == "" || email == "" || password == "" || confirmPassword == "" || phone == "" || gender == null) {
    alert("Please fill out all fields.");
    return false;
  }
  
  if (!phone.match(/^98\d{8}$/)) {
    alert("Please enter a valid phone number starting with 98 and 10 digits in total.");
    return false;
  }

  if (password != confirmPassword) {
    alert("Passwords do not match.");
    return false;
  }
  
  return true;
}
</script>
</head>
<body class="sub_page about_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
              <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                  <a class="navbar-brand" href="index.php">
                    <img src="../images/logo.png" alt="" />
                    <span>
                      Grande Sports Center
                    </span>
                  </a>
                </nav>
              </div>
            </header>
            <!-- end header section -->
            <!-- starting section -->            
            <section class=" starting_section position-relative">
              <div class="container">
                <div class="custom_nav2">
                  <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>       
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <div class="d-flex  flex-column flex-lg-row align-items-center">
                        <ul class="navbar-nav  ">
                          <li class="nav-item ">
                            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/aboutus.php">About Us</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/facilities.php">Facilities </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/gallery.php">Gallery</a>
                          </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

<!-- Section 3 -->
<div class="max-w-md mx-auto my-8 bg-white p-6 rounded-md shadow-md">
  <h1 class="text-xl font-medium mb-4">Registration</h1>
  <form action="../val/reg_val.php" method="post" onsubmit="return validateForm()">
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="first_name">First Name</label>
      <input class="border border-gray-300 p-2 w-full" type="text" id="first_name" name="first_name" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="last_name">Last Name</label>
      <input class="border border-gray-300 p-2 w-full" type="text" id="last_name" name="last_name" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="email">Email Address</label>
      <input class="border border-gray-300 p-2 w-full" type="email" id="email" name="email" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
      <input class="border border-gray-300 p-2 w-full" type="password" id="password" name="password" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="confirm_password">Confirm Password</label>
      <input class="border border-gray-300 p-2 w-full" type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2" for="phone">Phone Number</label>
      <input class="border border-gray-300 p-2 w-full" type="text" id="phone" name="phone" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2">Gender</label>
      <div>
        <label class="inline-flex items-center">
          <input type="radio" class="form-radio" name="gender" value="male" required>
          <span class="ml-2">Male</span>
        </label>
        <label class="inline-flex items-center ml-6">
          <input type="radio" class="form-radio" name="gender" value="female" required>
          <span class="ml-2">Female</span>
        </label>
      </div>
    </div>
    <div class="mb-6">
      <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" type="submit">Register</button>
    </div>
  </form>
  <p class="text-gray-600 text-sm">Already have an account? <a class="text-blue-500" href="user_login.php">Login here</a>.</p>
</div>

<!-- info section -->

<section class="info_section layout_padding2-top">

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <h6>
        About Grande Sports Center
      </h6>
      <p>
        Our facilities include two outdoor, all-weather 
        artificial turf futsal courts available for hire in Kathmandu! 
        The best place to spend your time getting fit and healthy!
      </p>
    </div>
    <div class="col-md-2 offset-md-1">
      <h6>
        Menus
      </h6>
      <ul>
        <li class=" active">
          <a class="" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="">
          <a class="" href="../main/aboutus.php">About </a>
        </li>
        <li class="">
          <a class="" href="../main/facilities.php">Facilities </a>
        </li>
        <li class="">
          <a class="" href="../main/gallery.php">Gallery</a>
        </li>
        <li class="">
          <a class="" href="#">Login</a>
        </li>
      </ul>
    </div>

    <div class="col-md-3">
      <h6>
        Contact Us
      </h6>
      <div class="info_link-box">
        <a href="">
          <img src="../images/location-white.png" alt="">
          <span> Dhapasi, Tokha</span>
        </a>
        <a href="">
          <img src="../images/call-white.png" alt="">
          <span>+01 51592901</span>
        </a>
        <a href="">
          <img src="../images/mail-white.png" alt="">
          <span> grandesportscenter@gmail.com</span>
        </a>
      </div>
      <div class="info_social">
        <div>
          <a href="">
            <img src="../images/facebook-logo-button.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/twitter-logo-button.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/linkedin.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/instagram.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- end info section -->


<!-- footer section -->
<section class="container-fluid footer_section ">
<p>
  &copy; 2019 All Rights Reserved. Grande Sports Center</a>
</p>
</section>
<!-- footer section -->

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<script>
function openNav() {
  document.getElementById("myNav").classList.toggle("menu_width");
  document
    .querySelector(".custom_menu-btn")
    .classList.toggle("menu_btn-style");
}
</script>
      <script>
  // Check if the URL parameter "status" is present and its value is "error"
  if (new URLSearchParams(window.location.search).get("status") === "error") {
    // Show the error popup
    alert("Email already exists. Please try again with a different email.");
  }
</script>

</body>
</html>
