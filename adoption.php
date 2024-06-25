<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>website</title>
  <link rel="stylesheet" href="adoption.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- navbar -->
  <nav class="navbar navbar-expand-xl fixed-top navbar-light">
    <div class="container-xxl">
      <a href="<?php echo isset($_SESSION['id']) ? 'user_db.php' : 'index.php'; ?>" class="navbar-brand text-decoration-none text-light fs-5">
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
          <?php if (isset($_SESSION['id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="user_db.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                My Account
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="user_db.php">Profile Details</a></li>
              <li><a class="dropdown-item" href="request.php">Request</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
            <a class="btn btn-login px-4" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

<div class="container">
            <?php
            echo md5("12345");
            ?>
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
</div>

<script defer src="nav.js"></script>

</body>
</html>