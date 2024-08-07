<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>website</title>
  <link rel="stylesheet" href="about.css">
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
  <div class="image-container d-flex justify-content-center align-items-center" style="height: 60vh; background-image: url('images/who.jpg'); background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(63, 200, 255, 0.5);"></div>
    <div class="con container-lg mb-5" style="position: relative; z-index: 1;">
      <div class="row justify-content-center">
        <div class="col-xl-12 text-center">
          <div class="quote display-3">Discover Our Identity</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec1">
  <div class="container container1">
    <div class="row justify-content-center align-items-center">
        <div class=" col-lg-8 text-center">
            <!-- Logo and text -->
            <div class="d-flex align-items-center justify-content-center mb-3">
                <img src="images/weblogo.png" alt="Logo" class="img-fluid mr-3" style="max-width: 100px;">
                <h2 class="m-0">AdoptAbility Foundation</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center"> <!-- Centering content horizontally and vertically -->
        <div class=" col-lg-8 text-center">
            <!-- Image -->
            <img src="images/orpbg.png" alt="Image" class="img-fluid mb-3">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class=" col-lg-8 text-justify">
            <!-- Paragraph text -->
            <p class="about text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim veniam beatae, natus aut vel est debitis labore vero aperiam ratione ad perferendis placeat quia in sapiente esse. Quae qui, enim ullam earum quia itaque corrupti placeat, blanditiis expedita corporis vitae quos deleniti dolore ipsa. Ab quisquam alias laborum neque? Debitis voluptatum molestias voluptates numquam inventore vero iusto, at consequatur laudantium? Nihil iusto totam aliquam omnis itaque, molestiae tempore quos voluptatem ratione neque dolorum nulla! Natus, modi nihil aperiam architecto eaque totam dolorum deserunt enim temporibus quis repellendus illo deleniti id a recusandae? Atque mollitia dolorem tenetur vitae laboriosam? Soluta, accusamus consectetur porro quasi magnam earum modi nam ullam dolores labore ipsum, sequi quidem mollitia vitae dolorum, repellat ipsam iusto eligendi. Sit, ipsa recusandae. Vero laborum totam omnis amet similique! Eius perferendis placeat sunt amet quam sed repudiandae unde ullam consequuntur, itaque inventore velit cumque labore sit ut explicabo, nulla quaerat?</p>
        </div>
    </div>
</div>
</section>

<section class="sec2">
  <div class="container container3">
      <div class="row justify-content-center text-center">
          <div class="col-md-4 col-md-6 col-lg-4 col-lg-6 col-xl-6 col-xxl-4">
              <div class="card mt-3" style="width: 100%; padding: 10px;">
                  <div class="card-body">
                      <h2 class="fw-bold">Our Mission</h2>
                      <img src="images/target.png" alt="Mission Logo" class="logov pt-3">
                      <p class="card-text pt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint vero veniam nisi commodi, modi eveniet necessitatibus molestiae. Ducimus aut vitae consequuntur voluptatibus, accusantium nulla laboriosam blanditiis obcaecati tempore, tenetur consectetur.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-md-6 col-lg-4 col-lg-6 col-xl-6 col-xxl-4">
              <div class="card mt-3" style="width: 100%; padding: 10px;">
                  <div class="card-body">
                      <h2 class="fw-bold">Our Vision</h2>
                      <img src="images/find.png" alt="Vision Logo" class="logov pt-3">
                      <p class="card-text pt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint vero veniam nisi commodi, modi eveniet necessitatibus molestiae. Ducimus aut vitae consequuntur voluptatibus, accusantium nulla laboriosam blanditiis obcaecati tempore, tenetur consectetur.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-md-6 col-lg-4 col-lg-6 col-xl-6 col-xxl-4">
              <div class="card mt-3" style="width: 100%; padding: 10px;">
                  <div class="card-body">
                      <h2 class="fw-bold">Our Team Values</h2>
                      <img src="images/value.png" alt="Team Values Logo" class="logov pt-3">
                      <p class="card-text pt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint vero veniam nisi commodi, modi eveniet necessitatibus molestiae. Ducimus aut vitae consequuntur voluptatibus, accusantium nulla laboriosam blanditiis obcaecati tempore, tenetur consectetur.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>


  <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title my-5">HOW YOU CAN <span class="highlight">HELP</span></h1>
        </div>
    </div>
</div>

<div class="sec3">
    <div class="container container4">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-6">
                <img src="images/donation.jpg" alt="donate" class="img-fluid float-start my-4">
                <p class="description custom-justified-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi autem voluptatem iste, ut nostrum eum dolores quas non voluptates sunt ab laborum sequi porro tempore reiciendis sit, quibusdam consequuntur rerum.</p>
                <button class="custom-button mb-5"d-flex>Donate</button>
            </div>
             <div class="col-md-6 col-lg-6">
                <img src="images/adoptch.jpg" alt="donate" class="img-fluid float-start my-4">
                <p class="description custom-justified-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae, officiis maxime ad cupiditate, temporibus dolorem animi nihil, qui libero provident veritatis. Exercitationem incidunt ipsa atque quis fuga nam doloremque modi.</p>
                <button class="custom-button mb-5">Adopt</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white" style="background-color: #3FC8FF">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Links -->
        <section class="">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="titles text-uppercase mb-4 fw-bold fs-4 text-center">
                        <img src="images/weblogo.png" alt="AdoptAbility Logo" width="75" height="60" class="s"> AdoptAbility Foundation
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse corrupti aperiam fugiat quibusdam inventore eligendi?
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 fw-bold">Contact</h6>
                    <p>
                        <i class="fas fa-home mr-3"></i>
                        <img src="images/loc.png" alt="location Logo" width="20" height="20"> <span>Tagalondon, NY 10012, PH</span>
                    </p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i>
                        <img src="images/email.png" alt="email Logo" width="20" height="20"> <span>adoptability@gmail.com</span>
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3"></i>
                        <img src="images/phone-call.png" alt="Phone Logo" width="20" height="20"> <span>+ 63 12 345 678</span>
                    </p>
                </div>
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
            </div>
            <!-- Grid row -->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Terms and Conditions -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-white" href="#">AdoptAbility Foundation</a>
        <a class="text-white ms-3" href="termsncondition.php">Terms and Conditions</a> <!-- Add your Terms and Conditions link here -->
    </div>
    <!-- Copyright -->
</footer>

<script defer src="nav.js"></script>

</body>
</html>