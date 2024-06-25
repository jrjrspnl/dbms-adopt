<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// Retrieve user information
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);

if (!$userData) {
    // Handle error if user not found
    header("Location: ../login.php");
    exit();
}

$name = isset($userData['name']) ? $userData['name'] : '';
$lastname = isset($userData['lastname']) ? $userData['lastname'] : '';
$email = isset($userData['email']) ? $userData['email'] : '';
$gender = isset($userData['gender']) ? $userData['gender'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update user information
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = strtolower($_POST['email']);
    $gender = $_POST['gender'];

    $updateSql = "UPDATE users SET name='$name', lastname='$lastname', email='$email', gender='$gender' WHERE username='$username'";
    if (mysqli_query($conn, $updateSql)) {
        // Redirect to user dashboard with success message
        header("Location: user_db.php?success=Profile updated successfully");
        exit();
    } else {
        // Redirect to user dashboard with error message
        header("Location: user_db.php?error=Failed to update profile");
        exit();
    }
}
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="user_db.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- navbar -->
  <nav class="navbar navbar-expand-xl fixed-top navbar-light">
    <div class="container-xxl">
      <a href="user_db.php" class="navbar-brand text-decoration-none text-light fs-5">
        <img class="logo" src="images/weblogo.png" width="85" height="65">AdoptAbility Foundation
      </a>
      <!-- toggle for mobile nav-->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- nav-bar links-->
      <div class="collapse navbar-collapse justify-content-end" id="main-nav">
        <ul class="navbar-nav fs-6 text-light text-center">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adoption.php">Adoption</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">Contact us</a>
          </li>
          <li class="nav-item d-none d-md-inline">
            <a class="btn btn-donate d-none d-xl-block" href="#">Donate</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              My Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="user_db.php">Profile Details</a></li>
            <li><a class="dropdown-item" href="request.php">Request</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<section id="sec">
  <div class="image-container d-flex justify-content-center align-items-center" style="height: 40vh; background-image: url('images/user_request_bg.jpg'); background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(63, 200, 255, 0.5);"></div>
    <div class="con container-lg mb-5" style="position: relative; z-index: 1;">
      <div class="row justify-content-center">
        <div class="col-xl-12 text-center">
          <div class="quote display-4 fw-bold">
          Welcome, <?php echo $_SESSION['name']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container mt-5" style="padding-top:70px; padding-bottom: 150px;">
    <h2 class="my-4">Profile Details</h2>
    <div class="row">
        <div class="col-md-6">
            <?php if(isset($_GET['success'])) { ?>
                <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
            <?php } elseif(isset($_GET['error'])) { ?>
                <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
            <?php } ?>
            <form method="POST">
                <div class="form-row mt-3 mb-3">
                    <div class="col-md-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="username" value="<?php echo $username; ?>" disabled>
                        <small class="text-danger">Username cannot be edited</small>
                    </div>
                </div>
                <div class="form-row mt-3 mb-3">
                    <div class="col-md-12">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="name" value="<?php echo $name; ?>" required>
                    </div>
                </div>
                <div class="form-row mt-3 mb-3">
                    <div class="col-md-12">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="family-name" value="<?php echo $lastname; ?>" required>
                    </div>
                </div>
                <div class="form-row mt-3 mb-3">
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="email" value="<?php echo $email; ?>" required>
                    </div>
                </div>
                <div class="form-row mt-3 mb-4">
                    <div class="col-md-12">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" <?php if($gender === 'male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if($gender === 'female') echo 'selected'; ?>>Female</option>
                            <option value="Other" <?php if($gender === 'other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-4">Update</button>
            </form>
        </div>
    </div>
</div>

<footer
          class="text-center text-lg-start text-white"
          style="background-color: #3FC8FF"
          >
    <!-- Grid container -->
    <div class="container p-4 pb-0 ">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="titles text-uppercase mb-4 fw-bold fs-4 text-center">
              <img src="images/weblogo.png" alt="AdoptAbility Logo" width="75" height="60" class="s"> <!-- Your logo -->
              AdoptAbility Foundation
              
            </h6>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse corrupti aperiam fugiat quibusdam inventore eligendi?
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

   
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 fw-bold">Contact</h6>
            <p><i class="fas fa-home mr-3"></i> 
              <img src="images/loc.png" alt="location Logo" width="20" height="20"> <!-- Your logo -->
              <span>Tagalondon, NY 10012, PH</span>
            </p>
            <p><i class="fas fa-envelope mr-3"></i> 
              <img src="images/email.png" alt="email Logo" width="20" height="20"> <!-- Your logo -->
              <span>adoptability@gmail.com</span>
            </p>
            <p>
              <i class="fas fa-phone mr-3"></i> <!-- Phone icon -->
              <img src="images/phone-call.png" alt="Phone Logo" width="20" height="20"> <!-- Your logo -->
              <span>+ 63 12 345 678</span> <!-- Phone number -->
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 mb-5">
            <h6 class="text-uppercase mb-4 fw-bold">Follow us</h6>
            <div>
              <a href="#" style="margin-right: 10px;"><img src="images/facebook.png" alt="Facebook Logo" width="30" height="30"></a>
              <a href="#" style="margin-right: 10px;"><img src="images/twitter.png" alt="Twitter Logo" width="30" height="30"></a>
              <a href="#"><img src="images/instagram.png" alt="Instagram Logo" width="30" height="30"></a>
              <!-- Add more social media icons as needed -->
            </div>
          </div>
<!-- Grid column -->

<!-- Grid column -->

        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2020 Copyright:
      <a class="text-white" href="#"
         >AdoptAbility Foundation</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <script defer src="nav.js"></script>
</body>
</html>