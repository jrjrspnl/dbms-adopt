<?php
session_start();

// Include database connection
require_once "db_conn.php";

// Check if user is authenticated
if (!isset($_SESSION['id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['id'];

// Fetch the adoption request status
$requestSql = "SELECT status FROM accepted_requests WHERE users_id = ?";
$requestStmt = $conn->prepare($requestSql);
$requestStmt->bind_param("i", $userId);
$requestStmt->execute();
$requestStmt->bind_result($status);
$requestStmt->fetch();
$requestStmt->close();

// Fetch the adoption request status
$requestSql = "SELECT status FROM request WHERE users_id = ?";
$requestStmt = $conn->prepare($requestSql);
$requestStmt->bind_param("i", $userId);
$requestStmt->execute();
$requestStmt->bind_result($status);
$requestStmt->fetch();
$requestStmt->close();

// Fetch the release request status
$requestSql = "SELECT process FROM released_requests WHERE users_id = ?";
$requestStmt = $conn->prepare($requestSql);
$requestStmt->bind_param("i", $userId);
$requestStmt->execute();
$requestStmt->bind_result($status);
$requestStmt->fetch();
$requestStmt->close();

// Fetch the user's registered status from the database
$sql = "SELECT registered FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($registered);
$stmt->fetch();
$stmt->close();


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="request.css">
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
            Request
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="container mt-5 mb-5" style="padding-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (!$registered): ?>
                <h2 class="my-4 mb-5">Request Form</h2>
                <div class="card">
                    <div class="card-header">Adoption Request Form</div>
                    <div class="card-body">
                        <form action="process_form.php" method="POST">
                            <!-- Personal Information -->
                            <h3>Personal Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <h3>Contact Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <h3>Additional Details</h3>
                            <div class="form-group mb-3">
                                <label for="gender">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="religion">Religion</label>
                                <input type="text" class="form-control" id="religion" name="religion" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="citizenship">Citizenship</label>
                                <input type="text" class="form-control" id="citizenship" name="citizenship" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="income">Estimated Income per Month</label>
                                <input type="number" class="form-control" id="income" name="income" required>
                            </div>

                            <!-- Adoption Questions -->
                            <h3>Adoption Questions</h3>
                            <div class="form-group mb-3">
                                <label>Are you willing to provide a loving and stable home environment for the child?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="yes1" value="yes" required>
                                    <label class="form-check-label" for="yes1">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="no1" value="no">
                                    <label class="form-check-label" for="no1">No</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Are you willing to provide financial and emotional support to the child?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question2" id="yes2" value="yes" required>
                                    <label class="form-check-label" for="yes2">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question2" id="no2" value="no">
                                    <label class="form-check-label" for="no2">No</label>
                                </div>
                            </div>

                            <!-- Additional Comments -->
                            <div class="form-group mb-3">
                                <label for="reason">Why do you want to adopt?</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="experience">Do you have any previous experience with adoption or fostering?</label>
                                <textarea class="form-control" id="experience" name="experience" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="support">What kind of support system do you have in place for the child?</label>
                                <textarea class="form-control" id="support" name="support" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="plans">What are your plans and expectations for the child's future?</label>
                                <textarea class="form-control" id="plans" name="plans" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="expectations">What are your expectations from AdoptAbility Foundation?</label>
                                <textarea class="form-control" id="expectations" name="expectations" rows="3" required></textarea>
                            </div>

                            <!-- Additional Message -->
                            <div class="form-group mb-4">
                                <label for="message">Any additional message you would like to add?</label>
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" name="send" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php elseif ($status == 'Accepted'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4 class="alert-heading">Congratulations!</h4>
                </div>
                <div>
                    <h4 style="padding-top: 20px;">Your adoption request has been accepted!</h4>
                    <p class="text-danger mt-4">Please check your email for further instructions on what documents to prepare for your visit to the orphanage.<br>Keep an eye on your inbox for the scheduled date and time of your visit. We look forward to welcoming you!</p>
                    <hr>
                    <p class="mb-5">Thank you for choosing AdoptAbility Foundation.</p>
                    <a href="#" class="btn btn-primary" role="button">Print Visit Form</a>
                    <p style="padding-bottom: 150px;"></p>
                </div>
                <?php elseif ($status == 'Rejected'): ?>
                  <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <h4 class="alert-heading">We're Sorry!</h4>
                  </div>
                  <div>
                      <h4 style="padding-top: 20px;">Your adoption request has been rejected.</h4>
                      <p class="text-danger mt-4">Unfortunately, after careful consideration, we are unable to proceed with your adoption request at this time.<br>Please contact us for further information or clarification regarding this decision.</p>
                      <hr>
                      <p class="mb-5">Thank you for considering AdoptAbility Foundation.</p>
                      <p style="padding-bottom: 150px;"></p>
                  </div>
                  <?php elseif ($status  == 'Released'): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h4 class="alert-heading">Congratulations!</h4>
                    </div>
                    <div>
                        <h4 style="padding-top: 20px;">We are delighted to inform you that your adoption has been successfully finalized.</h4>
                        <p class="text-success mt-4">This wonderful milestone marks the official welcoming of a new member into your family. We hope this journey brings immense joy, love, and fulfillment to your household for years to come.</p>
                        <hr>
                        <p class="mb-5">Thank you for choosing AdoptAbility Foundation.</p>
                        <p style="padding-bottom: 150px;"></p>
                    </div>
            <?php else: ?>
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4 class="alert-heading">Registration Successful!</h4>
                </div>
                <div>
                    <h6 style="padding-top: 20px;">Your information is now securely stored with us and will be reviewed by our dedicated team.<br>We appreciate your trust in us. Rest assured, we will carefully review your details to ensure a smooth experience. </h6>
                    <p class="text-danger">[Please keep an eye on your email inbox. We will notify you as soon as the review process is complete.]</p>
                </div>
                <hr>
                <p class="mb-5" style="padding-bottom: 150px;">Thank you for your submission.<br>If you have any questions or need further assistance, feel free to contact our support team.</p>
            <?php endif; ?>
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


</body>
</html>