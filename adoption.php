<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>website</title>
  <link rel="stylesheet" href="donation.css">
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
            <a class="btn btn-donate d-none d-xl-block" href="donation.php">Donate</a>
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

  <section id="sec">
  <div class="image-container d-flex justify-content-center align-items-center" style="height: 60vh; background-image: url('images/how.jpg'); background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(63, 200, 255, 0.5);"></div>
    <div class="con container-lg mb-5" style="position: relative; z-index: 1;">
      <div class="row justify-content-center">
        <div class="col-xl-12 text-center">
          <div class="quote display-3 light-bold">How?</div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container-fluid"  style="padding-bottom: 100px;">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h1 class="text-center" style="padding-bottom: 50px;" >Step-by-Step Adoption Process</h1>
            
            <div class="step my-4">
                <h2>1. Create an Account and Login</h2>
                <p class=fs-5>Welcome to Adoptability Foundation, where we facilitate the journey of adoption with compassion and care. To begin your adoption journey, create an account on our secure platform. Simply provide your email address, choose a password, and fill out basic information about yourself. Once registered, you can log in to access our adoption services.</p>
            </div>

            <div class="step my-4">
                <h2>2. Complete Registration Form and Questionnaire</h2>
                <p class=fs-5>Upon logging in, you will be guided through a comprehensive registration form. This form collects essential details about your personal background, family situation, and motivations for adoption. Additionally, you will complete a thoughtful questionnaire designed to assess your readiness and suitability to provide a loving and stable home for a child in need.</p>
            </div>

            <div class="step my-4">
                <h2>3. Database Storage</h2>
                <p class=fs-5>Your completed registration form and questionnaire are securely stored in our database. This ensures that your information remains confidential and accessible for our adoption review process. Each submission is linked to your account, allowing for easy updates and reference throughout the adoption process.</p>
            </div>

            <div class="step my-4">
                <h2>4. Review and Evaluation</h2>
                <p class=fs-5>Our experienced team at Adoptability Foundation carefully reviews each submission. We assess various factors such as your emotional readiness, financial stability, and commitment to parenting. This thorough evaluation helps us determine the best possible match between prospective parents and children awaiting adoption.</p>
            </div>

            <div class="step my-4">
                <h2>5. Notification of Acceptance</h2>
                <p class=fs-5>After reviewing your application, we will notify you via email regarding the status of your application. If accepted, the email will contain congratulations and further instructions. You will gain access to your adoption dashboard, where you can find important documents and next steps towards finalizing the adoption process.</p>
            </div>

            <div class="step my-4">
                <h2>6. Dashboard Access</h2>
                <p class=fs-5>Upon acceptance, log in to your account and access your personalized adoption dashboard. Here, you will find printable documents necessary for your adoption journey. Detailed guidance and resources will be provided to assist you through each stage, ensuring a smooth and supportive experience towards welcoming a child into your family.</p>
            </div>

            <div class="step my-4">
                <h2>7. Adoption Center Interaction</h2>
                <p class=fs-5>Visit our adoption center for an in-person meeting with our dedicated staff. We believe in personal interaction to better understand your aspirations and to address any questions you may have. Interviews and discussions will further determine the compatibility and readiness for adoption.</p>
            </div>

            <div class="step my-4">
                <h2>8. Adoption Decision</h2>
                <p class=fs-5>Our commitment is to make decisions that prioritize the well-being of children and the suitability of adoptive families. Final adoption decisions are made by our knowledgeable team or designated authorities at the adoption center. Approved applicants will proceed with legal procedures, while those not approved will receive constructive feedback and support for future applications.</p>
            </div>
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
</div>

<script defer src="nav.js"></script>

</body>
</html>