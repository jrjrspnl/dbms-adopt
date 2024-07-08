<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>website</title>
  <link rel="stylesheet" href="register.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- navbar -->
<nav class="navbar navbar-expand-xl fixed-top navbar-light">
  <div class="container-xxl">
    <a href="register.php" class="navbar-brand text-decoration-none text-light fs-5">
      <img class="logo" src="images/weblogo.png" width="85" height="65">AdoptAbility Foundation
    </a>
    <!-- toggle for mobile nav-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- nav-bar links-->
    <div class="collapse navbar-collapse justify-content-end" id="main-nav">
      <ul class="navbar-nav fs-6 text-light text-center ">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php" >About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adoption.php">Adoption</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact us</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-donate d-none d-xl-block" href="Donation.php">Donate</a>
        </li>
        <li class="nav-item d-none d-md-inline">
        <a class="btn btn-login px-4" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid p-0">
    <div class="image-container position-relative d-flex justify-content-center align-items-center" style="background-image: url('images/register_bg.jpg'); background-size: cover; background-position: center; min-height: 100vh;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(63, 200, 255, 0.5);"></div>
        <div class="container d-flex justify-content-center align-items-center flex-column" style="padding-top: 80px;">
            <form class="border shadow p-3 rounded" action="php/check-register.php" method="post" style="max-width: 600px; background-color: rgba(255, 255, 255, 0.8); position: relative; z-index: 1;">
                <h1 class="text-center p-2 fs-2 fw-bold">REGISTER</h1>
                <?php if(isset($_GET['success'])){ ?>
                    <div class="alert alert-success" role="alert">
                      <?=$_GET['success']?>
                    </div>
                <?php }?>
                
                <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                </div>
                <?php }?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (8 characters or more, with at least one letter and one number)</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
                <div class="mb-3">
                    <div class="form-check mb-4">
                        <input class="form-check-input " type="checkbox" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="termsncondition.php" target="_blank">Terms and Conditions</a>
                        </label>
                    </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                
            </form>
            <div class="container">
            </div>
        </div>
    </div>
</div>


<div class="container-fluid bg-light" style="padding-top: 100px; padding-bottom: 100px;">
    <h2 class="text-center">Thank you for supporting AdoptAbility Foundation</h2>
    <p class="text-center">Our mission is to help every child find a loving and supportive family. Join us in making a difference!</p>
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

</div>
</body>
</html>