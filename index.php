

<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>website</title>
  <link rel="stylesheet" href="style.css">
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

  <body class="bg-image">
    <section id="sec"> 
      <div class="image-container">
        <div class="con container-lg mb-5">
          <div class="row justify-content-start align-items-center">
            <div class="col-xl-5 text-center text-xl-start">
              <h1>  
                <div class="quote display-4">Each one of us can make a difference.</div>
                <div class="quote2 display-4 fw-bolder">Together we can make change.</div>
              </h1>
              <p class="lead my-4 text-light">Ready to make a difference? Whether you're looking to provide a loving home or support our cause, choose your path below and join us in changing lives.</p>
              <?php if (!isset($_SESSION['id'])): ?>
                <a href="register.php" class="btn btn-primary fw-bold btn-lg mx-2">Adopt now</a>
              <?php endif; ?>
              <a href="donation.php" class="btn btn-outline-primary fw-bold btn-lg">Donate</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  
<div class="quotes">
  <div class="oms text-center fw-bold fw">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti laborum aliquam culpa assumenda obcaecati suscipit velit. Alias explicabo tempore quam praesentium odit! Excepturi quibusdam hic consectetur, pariatur repellendus distinctio veniam.
  </div>
</div>

<!-- content 1 -->
<div class="main-container">
  <div class="container container1">
    <div class="row">
      <div class="col-md-8 col-lg-6 offset-lg-2 col-xl-6 col-xxl-6 offset-md-2">
        <div class="noob">
          <h2 class="title fw-bold px-4 mb-4">LEARN OUR STORY</h2>
          <p class="description custom-justified-text px-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi autem voluptatem iste, ut nostrum eum dolores quas non voluptates sunt ab laborum sequi porro tempore reiciendis sit, quibusdam consequuntur rerum.</p>
          <button class="custom-button">Learn more</button>
        </div>
      </div>
      <div class="col-md-12 col-lg-4 col-xl-4 offset-x1-1 col-xxl-4">
        <div class="images-container">
          <div class="image">
            <img src="images/image3.jpg" alt="Read" class="img-fluid d-none d-lg-block" aria-label="Donate">
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- content 2-->

<section class="childs">
  <div class="container container2 my-5">
      <div class="row">
          <div class="col">
              <div class="img-container position-relative">
                  <img src="images/aa.png" class="img-fluid" alt="Cropped Image">
                  <div class="overlay"></div>
                  <div class="text-inside-img position-absolute top-50 start-50 translate-middle">
                      <h2 class="overlay-text">EVERY CHILD DESERVES A FAMILY</h2>
                  </div>
              </div>
              <div class="paragraph-below-overlay py-3 mx-3 text-center">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat est alias quae, eos tempore animi accusamus quod, tempora, delectus deserunt at velit doloremque vitae aperiam eum nemo voluptates? Possimus nulla aperiam fuga error itaque id doloribus? Aliquid corporis facere tempora eveniet ipsum natus accusantium facilis. Facilis atque maiores, aliquid exercitationem quas ea possimus. Consectetur maxime distinctio fugiat provident officiis illo accusamus expedita quas! Doloremque minima quae facere obcaecati fugit quaerat, explicabo reprehenderit asperiores voluptates commodi fugiat dolor delectus consequuntur blanditiis, corporis similique ut exercitationem dignissimos laboriosam rem aut, optio odio! Nulla repellendus illo tempore veritatis soluta maiores voluptates optio repudiandae.</p>
              </div>
              <div class="logos-container">
                  <div class="logo"><img src="images/houselogo.png" alt="Logo 1"></div>
                  <div class="logo"><img src="images/fami.png" alt="Logo 2"></div>
                  <div class="logo"><img src="images/carelogo.png" alt="Logo 3"></div>
              </div>
          </div>
      </div>
  </div>
</section>

<section class="new-section">
  <div class="container container3 my-5">
      <div class="row">
          <div class="col">
              <h2 class="title text-center mb-5">Your donation aids ADBF in achieving its goals of:</h2>
              <div class="text-with-logo">
                  <div class="logo-container">
                      <img src="images/foodlogo.png" alt="Logo 1" class="mx-2">
                  </div>
                  <div class="text-container">
                      <p class="mx-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi beatae recusandae porro voluptatem consequuntur accusantium quod quia autem, natus aliquam hic error odit fugiat saepe unde modi. Excepturi, porro mollitia.</p>
                  </div>
              </div>
              <div class="text-with-logo">
                  <div class="logo-container right">
                      <img src="images/aidlogo.png" alt="Logo 2" class="mx-2">
                  </div>
                  <div class="text-container">
                      <p class="mx-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam dolore cumque alias eum? Sequi nemo possimus, dolor voluptates minus voluptatem, distinctio soluta perferendis temporibus, velit doloremque odio quia nihil quibusdam!</p>
                  </div>
              </div>
              <div class="text-with-logo">
                  <div class="logo-container right">
                      <img src="images/familylogo.png" alt="Logo 2" class="mx-2">
                  </div>
                  <div class="text-container">
                      <p class="mx-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil, id magnam sint voluptatum nulla laborum aspernatur ab quaerat temporibus accusantium in nesciunt, mollitia nostrum repellendus? Et iste quibusdam excepturi quas.</p>
                  </div>
              </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

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

