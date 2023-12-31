<?php
session_start();
require_once '../val/db_connect.php';

// Function to cancel a booking
function cancelBooking($bookingId)
{
    global $conn; // Add this line to access the $conn variable inside the function

    // Check if the booking belongs to the logged-in user
    $bookingCheckSql = "SELECT * FROM booking WHERE id = $bookingId AND client_id = {$_SESSION['user_id']}";
    $bookingCheckResult = $conn->query($bookingCheckSql);

    if ($bookingCheckResult->num_rows > 0) {
        // Booking exists, update the status to "Cancelled"
        $cancelBookingSql = "UPDATE booking SET status = 'Cancelled' WHERE id = $bookingId";

        if ($conn->query($cancelBookingSql) === TRUE) {
            echo "Booking with ID $bookingId has been cancelled successfully.";
        } else {
            echo "Error cancelling the booking: " . $conn->error;
        }
    } else {
        echo "Booking with ID $bookingId does not exist or does not belong to the current user.";
    }
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
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <style>
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
  table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .cancel-button {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 6px 12px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      cursor: pointer;
    }
</style>
</head>

<body class="sub_page about_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php
    
    if(isset($_SESSION['user_id'])) {
    // Fetch user details from the database
    $sql = "SELECT first_name FROM users WHERE id = ".$_SESSION['user_id'];
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    // Fetch bookings for the logged-in user
    $bookingSql = "SELECT b.*, f.name AS facility_name
    FROM booking b
    INNER JOIN facilities f ON b.facility_id = f.id
    WHERE b.client_id = ".$_SESSION['user_id'];
    $bookingResult = $conn->query($bookingSql);

    // Display dropdown menu with user name and links
    echo '
    <header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="../index.php">
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
                <li class="nav-item">
                  <a class="nav-link" href="../index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="myBooking.php">My Bookings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="user_profile.php">Profile</a>
            <li class="nav-item">
                  <a class="nav-link" href="../user/logout.php">Logout</a>
                </li>';
            } else {
              header('Location: user_login.php');
                exit();
            }
            ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

    <!-- admin bookings data section -->
    <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>All Bookings</h2>
      </div>
      <div class="box">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Reference Code</th>
              <th>User</th>
              <th>Facility</th>
              <th>Schedule</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
                  // Fetch bookings for the logged-in user
                  $bookingSql = "SELECT b.*, f.name AS facility_name, u.first_name, u.last_name
                  FROM booking b
                  INNER JOIN facilities f ON b.facility_id = f.id
                  INNER JOIN users u ON b.client_id = u.id
                  WHERE b.client_id = " . $_SESSION['user_id'];
                  $bookingResult = $conn->query($bookingSql);
                  

            if ($bookingResult->num_rows > 0) {
                $count = 1;
                while ($bookingRow = $bookingResult->fetch_assoc()) {
                    // Extract booking details
                    $dateFrom = $bookingRow['date_from'];
                    $dateTo = $bookingRow['date_to'];
                    $referenceCode = $bookingRow['ref_code'];
                    $facilityName = $bookingRow['facility_name'];
                    $schedule = $bookingRow['time_from'] . ' - ' . $bookingRow['time_to'];
                    $status = $bookingRow['status'];
                    $userName = $bookingRow['first_name'] . ' ' . $bookingRow['last_name'];
                    $bookingId = $bookingRow['id'];
                    ?>
                    <tr>
                      <td><?php echo $count++; ?></td>
                      <td><?php echo $dateFrom; ?></td>
                      <td><?php echo $referenceCode; ?></td>
                      <td><?php echo $userName; ?></td>
                      <td><?php echo $facilityName; ?></td>
                      <td><?php echo $schedule; ?></td>
                      <td><?php echo ucfirst($status); ?></td>
                      <td>
                        <?php
                          if ($status !== 'Cancelled') {
                              echo '<button class="cancel-button" onclick="cancelBooking(' . $bookingId . ')">Cancel</button>';
                          } else {
                              echo 'Cancelled';
                          }
                        ?>
                      </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="8">No bookings found</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- end admin bookings data section -->

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
    function cancelBooking(bookingId) {
        if (confirm('Are you sure you want to cancel this booking?')) {
            // Make an AJAX request to cancel the booking
            $.ajax({
                url: '../booking/cancel_booking.php', 
                type: 'POST',
                data: { bookingId: bookingId },
                success: function (response) {
                    if (response === 'success') {
                        // Do something if the cancellation was successful, if needed
                        // For example, update the UI to reflect the cancelled booking
                        // Reload the page to update the booking status
                        location.reload();
                    } else {
                        alert('Failed to cancel booking');
                    }
                },
                error: function () {
                    alert('An error occurred while cancelling the booking.');
                }
            });
        }
    }
</script>


<script>
function openNav() {
  document.getElementById("myNav").classList.toggle("menu_width");
  document
    .querySelector(".custom_menu-btn")
    .classList.toggle("menu_btn-style");
}
</script>
</body>

</html>