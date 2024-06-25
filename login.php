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
    <a href="login.php" class="navbar-brand text-decoration-none text-light fs-5">
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
        <a class="btn btn-donate d-none d-xl-block" href="#">Donate</a>
        </li>
        <li class="nav-item d-none d-md-inline">
        <a class="btn btn-login px-4" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid p-0">
    <div class="image-container position-relative d-flex justify-content-center align-items-center" style="background-image: url('images/login_bg.jpg'); background-size: cover; background-position: center; min-height: 100vh;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(63, 200, 255, 0.5);"></div>
        <div class="container d-flex justify-content-center align-items-center">
            <form class="border shadow p-3 rounded" action="php/check-login.php" method="post" style="max-width: 100%; width: 450px; background-color: rgba(255, 255, 255, 0.8); position: relative; z-index: 1;">
                <h1 class="text-center p-3 fw-bold">Sign In</h1>
                <?php if(isset($_GET['error'])){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?=$_GET['error']?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }?>

                <div class="mb-1">
                    <label class="form-label">Select User type:</label>
                </div>

                <select class="form-select mb-3" name="role" aria-label="Default select example">
                    <option selected value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="container d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary btn-lg">Sign in now</button>
               </div>
               
                <div class="mt-3 text-center">
                    <span>Don't have an account? </span><a href="register.php">Register here</a>
                </div>        
            </form>
        </div>
    </div>
</div>


<div class="container my-5 py-3">
    <h2 class="text-center mt-5">Thank you for supporting AdoptAbility Foundation</h2>
    <p class="text-center mb-5">Our mission is to help every child find a loving and supportive family. Join us in making a difference!</p>
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

</div>
</body>
</html>