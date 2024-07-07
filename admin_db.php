<?php
require "db_conn.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch username from database
$name = '';
$Id = $_SESSION['id']; // Assuming you store id in the session

$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt->bind_param("i", $Id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- datatables css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
    <!-- my custom css -->
    <link rel="stylesheet" href="admin_db.css"/>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- datatables-- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<!-- my custom js -->
<script defer src="datatablesfr.js"></script>
<script defer src="datatablesfr2.js"></script>
<script defer src="datatablesfr3.js"></script>
<script defer src="datatablesfr4.js"></script>
<script defer src="data.js"></script>

<title>Admin Dashboard</title>
</head>
<body>
  
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg" id="sidebar-wrapper" style="background-color: rgba(63, 200, 255);">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <h5 class="name fw-bold" style="color: rgb(255, 255,255);">ADBF Foundation</h5>
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#" id="dashboardLink" class="list-group-item list-group-item-action bg-transparent second-text active"
                    style="color: rgb(255, 255,255);" onclick="showContent('dashboard')"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
                    onclick="toggleSubMenu('projectsSubMenu')"><i class="fa-solid fa-children me-2"></i>Children</a>
                <div class="collapse" id="projectsSubMenu">
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ms-3" onclick="showContent('children')"><i
                            class="fas fa-plus me-2"></i>Children</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ms-3" onclick="showContent('adopted')"><i
                            class="fas fa-edit me-2"></i>Adopted</a>
                </div>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
                    onclick="toggleSubMenu('analyticsSubMenu')"><i class="fa-solid fa-person-circle-question me-2"></i>Request</a>
                <div class="collapse" id="analyticsSubMenu">
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ms-3" onclick="showContent('request')"><i
                            class="fas fa-chart-bar me-2"></i>Pending Request</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ms-3" onclick="showContent('accepted')"><i
                            class="fas fa-history me-2"></i>In Progress</a>
                </div>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
                    onclick="toggleSubMenu('releaseData')"><i class="fa-solid fa-newspaper me-2"></i>Records</a>
                <div class="collapse" id="releaseData">
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ms-3" onclick="showContent('released')"><i
                            class="fa-solid fa-file-circle-check me-2"></i>Resolved</a>
                </div>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
<!-- Page Content -->
<div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($name); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

<!-- Page Content -->
<div id="page-content-wrapper">

    <!-- Content Sections -->
    <div id="dashboard" class="content-section">
        <!-- Your dashboard content here -->
        <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                    <?php
                        $child_query = "SELECT COUNT(childid) AS total_child FROM orphanage";
                        $child_query_run = mysqli_query($conn, $child_query);

                        if ($child_query_run) {
                            $child_data = mysqli_fetch_assoc($child_query_run);
                            $child_total = $child_data['total_child'];
                            echo '<h3 class="fs-2">' . $child_total . '</h3>';
                        } else {
                            echo '<h3 class="fs-2">0</h3>';
                        }
                        ?>
                        <p class="fs-5">Children</p>
                    </div>
                    <i class="fa-solid fa-children fs-1 primary-text p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                    <?php
                        $adopted_query = "SELECT COUNT(ChildID) AS total_adopted FROM adopted_children"; // Count the number of rows directly
                        $adopted_query_run = mysqli_query($conn, $adopted_query);

                        if ($adopted_query_run) {
                            $adopted_data = mysqli_fetch_assoc($adopted_query_run);
                            $adopted_total = $adopted_data['total_adopted'];
                            echo '<h3 class="fs-2">' . $adopted_total . '</h3>';
                        } else {
                            echo '<h3 class="fs-2">0</h3>';
                        }
                        ?>
                        <p class="fs-5">Adopted</p>
                    </div>
                    <i class="fa-solid fa-house fs-1 primary-text p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <?php
                        $users_query = "SELECT COUNT(id) AS total_users FROM users"; // Count the number of rows directly
                        $users_query_run = mysqli_query($conn, $users_query);

                        if ($users_query_run) {
                            $users_data = mysqli_fetch_assoc($users_query_run);
                            $users_total = $users_data['total_users'];
                            echo '<h3 class="fs-2">' . $users_total . '</h3>';
                        } else {
                            echo '<h3 class="fs-2">0</h3>';
                        }
                        ?>
                        <p class="fs-5">Users</p>
                    </div>
                    <i class="fas fa-users fs-1 primary-text p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <?php
                        // Query to count pending requests
                        $request_query = "SELECT COUNT(*) AS total_pending FROM request WHERE status = 'Pending'";
                        $request_query_run = mysqli_query($conn, $request_query);

                        if ($request_query_run) {
                            $request_data = mysqli_fetch_assoc($request_query_run);
                            $request_total = $request_data['total_pending'];
                            echo '<h3 class="fs-2">' . $request_total . '</h3>';
                        } else {
                            echo '<h3 class="fs-2">0</h3>';
                        }
                        ?>
                        <p class="fs-5">Pending Requests</p>
                    </div>
                    <i class="fa-solid fa-person-circle-question fs-1 primary-text p-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <div id="children" class="content-section" style="display: none;">
    <div class="container-fluid">
        <h2 class="text-center mb-5">Children's Information</h2>
        <div class="table-responsive">
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target='#addChildModal'>Add New Child</button>
            </div>
            <table id="childrenTable" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">DOB</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">DOA</th>
                        <th class="text-center">Caregiver</th>
                        <th class="text-center">Medical Information</th>
                        <th class="text-center">Educational Status</th>
                        <th class="text-center">Legal Status</th>
                        <th class="text-center">Contact Information</th>
                        <th class="text-center">Foster Parent</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch orphanage records from database
                    $sql = "SELECT * FROM orphanage";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr data-childid='{$row['ChildID']}'>";
                            echo "<td class='view_id'>{$row['ChildID']}</td>";
                            echo "<td><img src='{$row['ImagePath']}' class='img-fluid' style='max-width: 100px;' alt='Child Image'></td>";
                            echo "<td>{$row['Name']}</td>";
                            echo "<td>{$row['DateOfBirth']}</td>";
                            echo "<td>{$row['Gender']}</td>";
                            echo "<td>{$row['DateOfAdmission']}</td>";
                            echo "<td>{$row['GuardianCaregiver']}</td>";
                            echo "<td>{$row['MedicalInformation']}</td>";
                            echo "<td>{$row['EducationalStatus']}</td>";
                            echo "<td>{$row['LegalStatus']}</td>";
                            echo "<td>{$row['ContactInformation']}</td>";
                            echo "<td>{$row['FosterParent']}</td>";
                            echo "<td>";
                            echo "<div class='btn-group' role='group'>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-info mx-2 viewbtn'>View</button>";
                            echo "</form>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-primary editbtn'>Edit</button>";
                            echo "</form>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-danger mx-2 deletebtn' data-childid='{$row['ChildID']}'>Delete</button>";
                            echo "</form>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-warning mx-2 adoptbtn' data-childid='{$row['ChildID']}'>Adopt</button>";
                            echo "</form>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-secondary printbtn' onclick='printTableRow({$row['ChildID']})'>Print</button>";
                            echo "</form>";                    
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No records found</td></tr>";
                    }

                    // Close database connection
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="adopted" class="content-section" style="display: none;">
    <div class="container-fluid">
        <h2 class="text-center mb-5">Adopted Children</h2>
        <div class="table-responsive">
            <table id="adoptedTable" class="table table-striped text-center "style="width:100%">
                <thead>
                    <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">DOB</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">DOA</th>
                    <th class="text-center">Caregiver</th>
                    <th class="text-center">Medical Information</th>
                    <th class="text-center">Educational Status</th>
                    <th class="text-center">Legal Status</th>
                    <th class="text-center">Contact Information</th>
                    <th class="text-center">Foster Parent</th>
                    <th class="text-center">Date Adopted</th>
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM adopted_children";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr data-childid='{$row['ChildID']}'>";
                            echo "<td class='view_id text-start'>{$row['ChildID']}</td>";
                            echo "<td class='text-start'><img src='{$row['ImagePath']}' class='img-fluid' style='max-width: 100px;' alt='Child Image'></td>";
                            echo "<td class='text-start'>{$row['Name']}</td>";
                            echo "<td class='text-start'>{$row['DateOfBirth']}</td>";
                            echo "<td class='text-start'>{$row['Gender']}</td>";
                            echo "<td class='text-start'>{$row['DateOfAdmission']}</td>";
                            echo "<td class='text-start'>{$row['GuardianCaregiver']}</td>";
                            echo "<td class='text-start'>{$row['MedicalInformation']}</td>";
                            echo "<td class='text-start'>{$row['EducationalStatus']}</td>";
                            echo "<td class='text-start'>{$row['LegalStatus']}</td>";
                            echo "<td class='text-start'>{$row['ContactInformation']}</td>";
                            echo "<td class='text-start'>{$row['FosterParent']}</td>";
                            echo "<td class='text-start'>{$row['DateAdopted']}</td>";
                            echo "<td>";
                            echo "<div class='btn-group' role='group'>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-info mx-2 viewbtn'>View</button>";
                            echo "</form>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-secondary printbtn' onclick='printTableRow({$row['ChildID']})'>Print</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No adopted children found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="request" class="content-section" style="display: none;">
    <div class="container-fluid">
        <h2 class="text-center mb-5">Pending Request</h2>
        <div class="table-responsive">
            <table id="requestTable" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                    <th class="text-center">Request ID</th>
                    <th class="text-center">Full Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Address</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Religion</th>
                    <th class="text-center">Citizenship</th>
                    <th class="text-center">DOB</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Occupation</th>
                    <th class="text-center">Income</th>
                    <th class="text-center">Question 1</th>
                    <th class="text-center">Question 2</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Reason</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Experience</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Support</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Plans</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Expectations</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Message</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Submitted At</th>
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM request WHERE status != 'Rejected';";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['status'] != 'Rejected') {
                                echo "<tr id='row{$row['id']}'>";
                                echo "<td class='view_request_id text-center'>{$row['id']}</td>";
                                echo "<td class='text-center'>{$row['fullname']}</td>";
                                echo "<td class='text-center'>{$row['email']}</td>";
                                echo "<td class='text-center'>{$row['phone']}</td>";
                                echo "<td class='text-center small'>{$row['address']}</td>";
                                echo "<td class='text-center'>{$row['gender']}</td>";
                                echo "<td class='text-center'>{$row['religion']}</td>";
                                echo "<td class='text-center'>{$row['citizenship']}</td>";
                                echo "<td class='text-center'>{$row['dob']}</td>";
                                echo "<td class='text-center'>{$row['age']}</td>";
                                echo "<td class='text-center'>{$row['occupation']}</td>";
                                echo "<td class='text-center'>{$row['income']}</td>";
                                echo "<td class='text-center'>{$row['question1']}</td>";
                                echo "<td class='text-center'>{$row['question2']}</td>";
                                echo "<td class='text-center small'>{$row['reason']}</td>";
                                echo "<td class='text-center small'>{$row['experience']}</td>";
                                echo "<td class='text-center small'>{$row['support']}</td>";
                                echo "<td class='text-center small'>{$row['plans']}</td>";
                                echo "<td class='text-center small'>{$row['expectations']}</td>";
                                echo "<td class='text-center small'>{$row['message']}</td>";
                                echo "<td class='text-center'>{$row['status']}</td>";
                                echo "<td class='text-center'>{$row['created_at']}</td>";
                                echo "<td>";
                                echo "<div class='btn-group' role='group'>";
                                echo "<form>";
                                echo "<button type='button' class='btn btn-info mx-2 view-btn'>View</button>";
                                echo "</form>";
                                echo "<form id='acceptForm{$row['id']}' method='post' action='accept_request.php'>";
                                echo "<input type='hidden' name='request_id' value='{$row['id']}'>";
                                echo "<button type='button' class='btn btn-success mx-2 accept-btn' data-request-id='{$row['id']}'>Accept</button>";
                                echo "</form>";
                                echo "<form>";
                                echo "<button type='button' class='btn btn-danger mx-2 rejectbtn'>Decline</button>";   
                                echo "</form>";           
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="accepted" class="content-section" style="display: none;">
    <div class="container-fluid">
        <h2 class="text-center mb-5">In Progress</h2>
        <div class="table-responsive">
            <table id="acceptedTable" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                    <th class="text-center">Process ID</th>
                    <th class="text-center">Full Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Address</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Religion</th>
                    <th class="text-center">Citizenship</th>
                    <th class="text-center">DOB</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Occupation</th>
                    <th class="text-center">Income</th>
                    <th class="text-center">Question 1</th>
                    <th class="text-center">Question 2</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Reason</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Experience</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Support</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Plans</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Expectations</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Message</th>
                    <th class="text-center">Accepted At</th>
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM accepted_requests";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='text-center'>{$row['id']}</td>";
                            echo "<td class='view_request_id text-center'>{$row['id']}</td>";
                            echo "<td class='text-center'>{$row['email']}</td>";
                            echo "<td class='text-center'>{$row['phone']}</td>";
                            echo "<td class='text-center small'>{$row['address']}</td>";
                            echo "<td class='text-center'>{$row['gender']}</td>";
                            echo "<td class='text-center'>{$row['religion']}</td>";
                            echo "<td class='text-center'>{$row['citizenship']}</td>";
                            echo "<td class='text-center'>{$row['dob']}</td>";
                            echo "<td class='text-center'>{$row['age']}</td>";
                            echo "<td class='text-center'>{$row['occupation']}</td>";
                            echo "<td class='text-center'>{$row['income']}</td>";
                            echo "<td class='text-center'>{$row['question1']}</td>";
                            echo "<td class='text-center'>{$row['question2']}</td>";
                            echo "<td class='text-center small'>{$row['reason']}</td>";
                            echo "<td class='text-center small'>{$row['experience']}</td>";
                            echo "<td class='text-center small'>{$row['support']}</td>";
                            echo "<td class='text-center small'>{$row['plans']}</td>";
                            echo "<td class='text-center small'>{$row['expectations']}</td>";
                            echo "<td class='text-center small'>{$row['message']}</td>";
                            echo "<td class='text-center'>{$row['created_at']}</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-info mx-2 view-btn'>View</button>";
                            echo "</form>";
                            echo "<form method='post' action='release_request.php' class='release-form'>";
                            echo "<input type='hidden' name='request_id' value='{$row['id']}'>";
                            echo "<button type='button' class='btn btn-success mx-2 release-btn' onclick='confirmRelease({$row['id']})'>Release</button>";
                            echo "</form>";                                                            
                            echo "<form method='post' action='reject_request.php' class='release-form' id='rejectForm'>";
                            echo "<input type='hidden' name='request_id' value='{$row['id']}'>";
                            echo "<button type='button' class='btn btn-danger mx-2 reject-btn' onclick='confirmReject({$row['id']})'>Reject</button>";
                            echo "</form>";                                                                                                                                    
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                       
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="released" class="content-section" style="display: none;">
    <div class="container-fluid">
        <h2 class="text-center mb-5">Records</h2>
        <div class="table-responsive">
            <table id="releasedTable" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                    <th class="text-center">Process ID</th>
                    <th class="text-center">Full Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Address</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Religion</th>
                    <th class="text-center">Citizenship</th>
                    <th class="text-center">DOB</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Occupation</th>
                    <th class="text-center">Income</th>
                    <th class="text-center">Question 1</th>
                    <th class="text-center">Question 2</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Reason</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Experience</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Support</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Plans</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Expectations</th>
                    <th class="text-center" style="padding-left: 100px; padding-right: 100px;">Message</th>
                    <th class="text-center">Released At</th>
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM released_requests";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='view_request_id text-center'>{$row['id']}</td>";
                            echo "<td class='text-center'>{$row['fullname']}</td>";
                            echo "<td class='text-center'>{$row['email']}</td>";
                            echo "<td class='text-center'>{$row['phone']}</td>";
                            echo "<td class='text-center small'>{$row['address']}</td>";
                            echo "<td class='text-center'>{$row['gender']}</td>";
                            echo "<td class='text-center'>{$row['religion']}</td>";
                            echo "<td class='text-center'>{$row['citizenship']}</td>";
                            echo "<td class='text-center'>{$row['dob']}</td>";
                            echo "<td class='text-center'>{$row['age']}</td>";
                            echo "<td class='text-center'>{$row['occupation']}</td>";
                            echo "<td class='text-center'>{$row['income']}</td>";
                            echo "<td class='text-center'>{$row['question1']}</td>";
                            echo "<td class='text-center'>{$row['question2']}</td>";
                            echo "<td class='text-center small'>{$row['reason']}</td>";
                            echo "<td class='text-center small'>{$row['experience']}</td>";
                            echo "<td class='text-center small'>{$row['support']}</td>";
                            echo "<td class='text-center small'>{$row['plans']}</td>";
                            echo "<td class='text-center small'>{$row['expectations']}</td>";
                            echo "<td class='text-center small'>{$row['message']}</td>";
                            echo "<td class='text-center'>{$row['created_at']}</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<form>";
                            echo "<button type='button' class='btn btn-info mx-2 view-btn'>View</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                    }
                    
                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
      </div>
    </div>
</div>

<!-- View Child Modal -->
<div class="modal fade" id="viewChildModal" tabindex="-1" aria-labelledby="viewChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewChildModalLabel">View Child Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="view_child_data">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
     

<!-- View Request Modal -->
<div class="modal fade" id="viewRequestModal" tabindex="-1" aria-labelledby="viewRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRequestModalLabel">View User's Request Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="view_request_data">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <!-- Edit Child Modal -->
<div class="modal fade" id="editChildModal" tabindex="-1" aria-labelledby="editChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal-dialog size as needed -->
       <form action="update_child.php" id="editChildForm" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChildModalLabel">Edit Child Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="alert alert-danger d-none" id="imageAlert" role="alert">
                     Please upload an image file.
                </div>
                    <!-- Hidden input field for ChildID -->
                    <input type="hidden" id="editChildID" name="editChildID">
                    <div class="mb-3">
                      <label for="editimagePath" class="form-label">Image Upload</label>
                      <input type="file" class="form-control" id="editimagePath" name="editImageFile">
                      <small class="text-muted">Upload a profile image of the child.</small>
                  </div>
                    <!-- Input fields for editing child information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editChildName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editChildName" name="Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editDateOfBirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="editDateOfBirth" name="DateOfBirth">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editGender" class="form-label">Gender</label>
                            <select class="form-select" id="editGender" name="Gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editDateOfAdmission" class="form-label">Date of Admission</label>
                            <input type="date" class="form-control" id="editDateOfAdmission" name="DateOfAdmission">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editGuardianCaregiver" class="form-label">Guardian/Caregiver</label>
                        <input type="text" class="form-control" id="editGuardianCaregiver" name="GuardianCaregiver">
                    </div>
                    <div class="mb-3">
                        <label for="editMedicalInfo" class="form-label">Medical Information</label>
                        <input type="text" class="form-control" id="editMedicalInfo" name="MedicalInformation">
                    </div>
                    <div class="mb-3">
                        <label for="editEducationStatus" class="form-label">Educational Information</label>
                        <select class="form-select" id="editEducationStatus" name="EducationalStatus">
                            <option value="Preschool">Preschool</option>
                            <option value="Kindergarten">Kindergarten</option>
                            <option value="Elementary">Elementary</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editLegalStatus" class="form-label">Legal Status</label>
                        <select class="form-select" id="editLegalStatus" name="LegalStatus">
                            <option value="Legal custody pending adoption">Legal custody pending adoption</option>
                            <option value="Available for adoption">Available for adoption</option>
                            <option value="Waiting for foster care">Waiting for foster care</option>
                            <option value="Foster care arrangement">Foster care arrangement</option>
                            <option value="Legal guardian appointed">Legal guardian appointed</option>
                            <option value="Pending court decision">Pending court decision</option>
                            <option value="Waiting for foster placement">Waiting for foster placement</option>
                            <option value="Adopted">Adopted</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editContactInfo" class="form-label">Contact Information</label>
                        <input type="text" class="form-control" id="editContactInfo" name="ContactInformation">
                    </div>
                    <div class="mb-3">
                        <label for="editFosterParent" class="form-label">Foster Parent</label>
                        <input type="text" class="form-control" id="editFosterParent" name="FosterParent">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add Child Modal -->
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="addChildModalLabel">Add New Child Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addChildForm" enctype="multipart/form-data">
        <div class="modal-body">
        <div class="alert alert-warning d-none"></div>
        <div class="mb-3">
          <label for="imagePath" class="form-label">Image Upload</label>
          <input type="file" class="form-control" id="imagePath" name="ImageFile">
          <small class="text-muted">Upload a profile image of the child.</small>
      </div>
      <div class="row">
     <div class="col-md-6 mb-3">
        <label for="childName" class="form-label">Name</label>
        <input type="text" class="form-control" id="childName" name="Name" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="dateOfBirth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="dateOfBirth" name="DateOfBirth">
      </div>
      <div class="col-md-6 mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="Gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="dateOfAdmission" class="form-label">Date of Admission</label>
        <input type="date" class="form-control" id="dateOfAdmission" name="DateOfAdmission">
      </div>
      <div class="mb-3">
        <label for="guardianCaregiver" class="form-label">Guardian/Caregiver</label>
        <input type="text" class="form-control" id="guardianCaregiver" name="GuardianCaregiver">
      </div>
      <div class="mb-3">
        <label for="medicalInfo" class="form-label">Medical Information</label>
        <input type="text" class="form-control" id="medicalInfo" name="MedicalInformation">
      </div>
      <div class="mb-3">
        <label for="educationStatus" class="form-label">Educational Status</label>
        <select class="form-select" id="educationStatus" name="EducationalStatus">
          <option value="Preschool">Preschool</option>
          <option value="Kindergarten">Kindergarten</option>
          <option value="Elementary">Elementary</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="legalStatus" class="form-label">Legal Status</label>
        <select class="form-select" id="legalStatus" name="LegalStatus">
          <option value="Legal custody pending adoption">Legal custody pending adoption</option>
          <option value="Available for adoption">Available for adoption</option>
          <option value="Waiting for foster care">Waiting for foster care</option>
          <option value="Foster care arrangement">Foster care arrangement</option>
          <option value="Legal guardian appointed">Legal guardian appointed</option>
          <option value="Pending court decision">Pending court decision</option>
          <option value="Waiting for foster placement">Waiting for foster placement</option>
          <option value="Adopted">Adopted</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="contactInfo" class="form-label">Contact Information</label>
        <input type="text" class="form-control" id="contactInfo" name="ContactInformation">
      </div>
      <div class="mb-3">
        <label for="fosterParent" class="form-label">Foster Parent</label>
        <input type="text" class="form-control" id="fosterParent" name="FosterParent">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary" name="save_child">Add Child</button>
    </div>
  </div>
</form>
  </div>
</div>

<script>
function printTableRow(childID) {
    // Find the table row corresponding to the childID
    var tableRow = document.querySelector("tr[data-childid='" + childID + "']");
    if (tableRow) {
        // Hide action buttons before printing
        var actionButtons = tableRow.querySelectorAll('.viewbtn, .printbtn');
        actionButtons.forEach(function(button) {
            button.style.display = 'none';
        });

        // Get image source directly from the table row
        var imageSrc = tableRow.querySelector("img").src;

        // Create a new window for printing
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        // Construct the HTML content to be printed
        printWindow.document.write("<html><head><title>Child Record</title>");
        // Optional: Add CSS for better print layout
        printWindow.document.write("<style>body { font-family: Arial, sans-serif; } table { width: 100%; border-collapse: collapse; margin-bottom: 20px; } th, td { border: 1px solid #ddd; padding: 8px; } img { max-width: 100%; height: auto; }</style>");
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h2 style='text-align: center;'>Child Information</h2>");
        // Print the image
        printWindow.document.write("<img src='" + imageSrc + "' class='img-fluid' style='max-width: 200px; float: right; display: block; margin: 0 auto; margin-bottom: 20px;' alt='Child Image'>");
        // Print specific columns only
        printWindow.document.write("<table>");
        printWindow.document.write("<tr><td><strong>Name:</strong></td><td>" + tableRow.querySelector("td:nth-child(3)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Date of Birth:</strong></td><td>" + tableRow.querySelector("td:nth-child(4)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Gender:</strong></td><td>" + tableRow.querySelector("td:nth-child(5)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Date of Admission:</strong></td><td>" + tableRow.querySelector("td:nth-child(6)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Caregiver:</strong></td><td>" + tableRow.querySelector("td:nth-child(7)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Medical Information:</strong></td><td>" + tableRow.querySelector("td:nth-child(8)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Educational Status:</strong></td><td>" + tableRow.querySelector("td:nth-child(9)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Legal Status:</strong></td><td>" + tableRow.querySelector("td:nth-child(10)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Contact Information:</strong></td><td>" + tableRow.querySelector("td:nth-child(11)").innerHTML + "</td></tr>");
        printWindow.document.write("<tr><td><strong>Foster Parent:</strong></td><td>" + tableRow.querySelector("td:nth-child(12)").innerHTML + "</td></tr>");
        printWindow.document.write("</table>");
        printWindow.document.write("</body></html>");
        printWindow.document.close();
        // Focus and print the new window
        printWindow.focus();
        printWindow.print();
        printWindow.close();

        // Restore action buttons visibility after printing
        actionButtons.forEach(function(button) {
            button.style.display = '';
        });
    } else {
        console.error("Child record with ID " + childID + " not found.");
        alert("Child record with ID " + childID + " not found. Please check your data.");
    }
}
</script>


<script>
$(document).ready(function() {
    // Event delegation for delete button click
    $('#childrenTable').on('click', '.deletebtn', function() {
        var childID = $(this).data('childid');
        
        // Using SweetAlert2 for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform deletion via AJAX
                $.ajax({
                    url: 'delete_child.php', // PHP script to handle delete operation
                    type: 'POST',
                    data: { childID: childID },
                    success: function(response) {
                        // Handle success response
                        Swal.fire('Deleted!', 'The record has been deleted.', 'success')
                            .then(() => {
                                location.reload(); // Reload page or update DataTables as needed
                            });
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status, error);
                        Swal.fire('Error!', 'Failed to delete the record.', 'error');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', 'The record deletion was cancelled.', 'info');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    $('.viewbtn').click(function (e) {
        e.preventDefault();

        var view_id = $(this).closest('tr').find('.view_id').text();

        $.ajax({
            method: "POST",
            url: "view_data.php",
            data: {
                'click_view_btn': true,
                'view_id': view_id,
            },
            success: function (response) {
                console.log(response);
                $('.view_child_data').html(response);
                $('#viewChildModal').modal('show');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    $('.view-btn').click(function (e) {
        e.preventDefault();

        var view_request_id = $(this).closest('tr').find('.view_request_id').text();

        $.ajax({
            method: "POST",
            url: "view_data.php",
            data: {
                'click_view_request_btn': true,
                'view_request_id': view_request_id,
            },
            success: function (response) {
                console.log(response);
                $('.view_request_data').html(response);
                $('#viewRequestModal').modal('show');
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $('#addChildForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Serialize form data
        var formData = new FormData($(this)[0]);

        // Submit form data using AJAX
        $.ajax({
            url: 'add_child.php', // PHP script that handles form data
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                console.log(response);
                Swal.fire({
                    title: 'SUCCESS!',
                    text: 'Child Information added successfully',
                    icon: 'success',
                    showConfirmButton: false, // Hide the default 'OK' button
                    timer: 1500 // Auto close alert after 1.5 seconds
                }).then(() => {
                    setTimeout(function() {
                        location.reload(); // Reload the page after a delay
                    }, 1000); // 1000 milliseconds = 1 second
                });
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while adding the child.',
                    icon: 'error'
                });
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#childrenTable')) {
        $('#childrenTable').DataTable().destroy();
    }

    $('#childrenTable').DataTable({
        // DataTable options and configurations
    });

    // Event delegation for edit button
    $('#childrenTable').on('click', '.editbtn', function() {
        // Handle edit button click event
        // Example code to open modal and populate fields
        var $tr = $(this).closest('tr');
        var data = $tr.find('td').map(function() {
            return $(this).text();
        }).get();

        // Populate modal fields with data from the clicked row
        $('#editChildModal').modal('show');
        $('#editChildID').val(data[0]);
        $('#editChildName').val(data[2]);
        $('#editDateOfBirth').val(data[3]);
        $('#editGender').val(data[4]);
        $('#editDateOfAdmission').val(data[5]);
        $('#editGuardianCaregiver').val(data[6]);
        $('#editMedicalInfo').val(data[7]);
        $('#editEducationStatus').val(data[8]);
        $('#editLegalStatus').val(data[9]);
        $('#editContactInfo').val(data[10]);
        $('#editFosterParent').val(data[11]);
    });
});
</script>


<script>
$(document).ready(function() {
    // Function to handle form submission via AJAX
    $('#editChildForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the browser

        // Serialize form data
        var formData = $(this).serialize();

        // AJAX request to update_child.php
        $.ajax({
            type: 'POST',
            url: 'update_child.php',
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    // Use SweetAlert2 for success message
                    Swal.fire({
                        title: 'SUCCESS!',
                        text: response.message,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Add a delay of 1 second (1000 milliseconds) before reloading
                            setTimeout(function() {
                                location.reload(); // Reload the page
                            }, 1000); // 1000 milliseconds = 1 second
                        }
                    });
                } else {
                    // Use SweetAlert2 for error message
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Use SweetAlert2 for AJAX request failure
                Swal.fire({
                    title: 'Error!',
                    text: 'AJAX request failed: ' + status + ', ' + error,
                    icon: 'error'
                });
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $('.adoptbtn').click(function() {
        var childID = $(this).data('childid');

        Swal.fire({
            title: 'Is this child already adopted?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'adopted_children.php', // PHP file to handle adoption process
                    data: { childID: childID },
                    success: function(response) {
                        Swal.fire({
                            title: 'Child adopted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Delay of 1000 milliseconds before reloading the page
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire('Error adopting child. Please try again.', '', 'error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Accept action
    $('.accept-btn').click(function() {
        var requestId = $(this).data('request-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to accept this request. This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accept'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'accept_request.php',
                    data: {
                        'accept_request': true,
                        'request_id': requestId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Accepted!',
                            text: 'The request has been accepted successfully.',
                            icon: 'success'
                        }).then((result) => {
                            location.reload(); // Reload the page or update the table dynamically
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing the request.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>
<script>
    function confirmReject(requestId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to reject this request. This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Reject'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'reject_request.php',
                    data: {
                        'reject_request': true,
                        'request_id': requestId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Rejected!',
                            text: 'The request has been rejected successfully.',
                            icon: 'success'
                        }).then((result) => {
                            location.reload(); // Reload the page or update the table dynamically
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing the request.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>
<script>
    function confirmRelease(requestId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to release this request. This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Release'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'release_request.php',
                    data: {
                        'release_request': true,
                        'request_id': requestId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Released!',
                            text: 'The request has been released successfully.',
                            icon: 'success'
                        }).then((result) => {
                            location.reload(); // Reload the page or update the table dynamically
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing the request.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>
<script>
  $(document).ready(function() {
    $('.rejectbtn').on('click', function() {
        var requestId = $(this).closest('tr').attr('id').replace('row', '');

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, send AJAX request to update status
                $.ajax({
                    url: 'reject.php',
                    type: 'POST',
                    data: { request_id: requestId },
                    success: function(response) {
                        if(response == 'success') {
                            // Show success message and reload the page
                            Swal.fire({
                                title: 'Rejected!',
                                text: 'The request has been rejected successfully.',
                                icon: 'success'
                            }).then((result) => {
                                location.reload(); // Reload the page or update the table dynamically
                            });
                        } else {
                            // Show error message
                            Swal.fire(
                                'Error!',
                                'Failed to update status.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    });
});

    </script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };

    function toggleSubMenu(submenuId) {
        var submenu = document.getElementById(submenuId);
        submenu.classList.toggle('show');
    }

    function showContent(contentId) {
        // Hide all content sections
        var contentSections = document.getElementsByClassName('content-section');
        for (var i = 0; i < contentSections.length; i++) {
            contentSections[i].style.display = 'none';
        }

        // Show the selected content section
        var selectedContent = document.getElementById(contentId);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    }

</script>
</body>
</html>