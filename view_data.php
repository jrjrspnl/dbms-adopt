<?php
include "db_conn.php";

if (isset($_POST['click_view_btn'])) {
    $id = $_POST['view_id'];

    $sql = "SELECT * FROM orphanage WHERE ChildID ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="row my-2 mx-3">
                    <div class="col-md-8">
                        <h2>Child Information</br></h2>
                        <h6><span class="fw-bold text-primary">Child ID:</span> '.$row['ChildID'].'</br></h6>
                        <h6><span class="fw-bold">Name:</span> '.$row['Name'].'</h6>
                        <h6><span class="fw-bold">Date of Birth:</span> '.$row['DateOfBirth'].'</br></h6>
                        <h6><span class="fw-bold">Gender:</span> '.$row['Gender'].'</br></h6>
                        <h6><span class="fw-bold">Date of Admission:</span> '.$row['DateOfAdmission'].'</br></h6>
                        <h6><span class="fw-bold">Guardian/Caregiver:</span> '.$row['GuardianCaregiver'].'</br></h6>
                        <h6><span class="fw-bold">Medical Information:</span> '.$row['MedicalInformation'].'</br></h6>
                        <h6><span class="fw-bold">Educational Status:</span> '.$row['EducationalStatus'].'</br></h6>
                        <h6><span class="fw-bold">Legal Status:</span> '.$row['LegalStatus'].'</br></h6>
                       <h6><span class="fw-bold">Contact Information:</span> '.$row['ContactInformation'].'</br></h6>
                    </div>
                    <div class="col-md-4">
                        <img src="'.$row['ImagePath'].'" class="img-fluid float-end" style="max-width: 200px;" alt="Child Image">
                    </div>
                </div>
            ';
        }
    } else {
       
    }
}

if (isset($_POST['click_view_btn'])) {
    $id = $_POST['view_id'];

    $sql = "SELECT * FROM adopted_children WHERE ChildID ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="row my-2 mx-3">
                    <div class="col-md-8">
                        <h4>Records of Adopted Child Information</br></h4>
                        <h6><span class="fw-bold text-primary">Child ID:</span> '.$row['ChildID'].'</br></h6>
                        <h6><span class="fw-bold">Name:</span> '.$row['Name'].'</h6>
                        <h6><span class="fw-bold">Date of Birth:</span> '.$row['DateOfBirth'].'</br></h6>
                        <h6><span class="fw-bold">Gender:</span> '.$row['Gender'].'</br></h6>
                        <h6><span class="fw-bold">Date of Admission:</span> '.$row['DateOfAdmission'].'</br></h6>
                        <h6><span class="fw-bold">Guardian/Caregiver:</span> '.$row['GuardianCaregiver'].'</br></h6>
                        <h6><span class="fw-bold">Medical Information:</span> '.$row['MedicalInformation'].'</br></h6>
                        <h6><span class="fw-bold">Educational Status:</span> '.$row['EducationalStatus'].'</br></h6>
                        <h6><span class="fw-bold">Legal Status:</span> '.$row['LegalStatus'].'</br></h6>
                       <h6><span class="fw-bold">Contact Information:</span> '.$row['ContactInformation'].'</br></h6>
                    </div>
                    <div class="col-md-4">
                        <img src="'.$row['ImagePath'].'" class="img-fluid float-end" style="max-width: 200px;" alt="Child Image">
                    </div>
                </div>
            ';
        }
    } else {
       
    }
}

if (isset($_POST['click_view_request_btn'])) {
    $id = $_POST['view_request_id'];

    $sql = "SELECT * FROM request WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="row my-2 mx-3">
                    <div class="col-md-12">
                        <h2>Personal Information</br></h2>
                        <h6><span class="fw-bold text-primary">Request ID:</span> '.$row['id'].'</br></h6>
                        <h6><span class="fw-bold">Name:</br></span> '.$row['fullname'].'</br></h6>
                        <h6><span class="fw-bold">Email Address:</br></span> '.$row['email'].'</br></h6>
                        <h6><span class="fw-bold">Contact Number:</br></span> '.$row['phone'].'</br></h6>
                        <h6><span class="fw-bold">Address:</br></span> '.$row['address'].'</br></h6>
                        <h6><span class="fw-bold">Gender:</br></span> '.$row['gender'].'</br></h6>
                        <h6><span class="fw-bold">Religion:</br></span> '.$row['religion'].'</br></h6>
                        <h6><span class="fw-bold">Citizenship:</br></span> '.$row['citizenship'].'</br></h6>
                        <h6><span class="fw-bold">Date of Birth:</br></span> '.$row['dob'].'</br></h6>
                        <h6><span class="fw-bold">Age:</br></span> '.$row['age'].'</br></br></h6>
                        <hr></hr>
                        <h2>Questions</br></h2>
                        <h6><span class="fw-bold text-success">Are you willing to provide a loving and stable home environment for the child?</br></span> '.$row['question1'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Are you willing to provide financial and emotional support to the child?</br></span> '.$row['question2'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Why do you want to adopt?</br></br></span> '.$row['reason'].'</h6>
                        <h6><span class="fw-bold text-success">Do you have any previous experience with adoption or fostering?</br></br></span> '.$row['experience'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What kind of support system do you have in place for the child?</br></br></span> '.$row['support'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your plans and expectations for the child`s future?</br></br></span> '.$row['plans'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your expectations from AdoptAbility Foundation?</br></br></span> '.$row['expectations'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Any additional message you would like to add?</br></br></span> '.$row['message'].'</br></br></h6>
                    </div>
                </div>
            ';
        }
    } else {
       
    }
}

if (isset($_POST['click_view_request_btn'])) {
    $id = $_POST['view_request_id'];

    $sql = "SELECT * FROM accepted_requests WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="row my-2 mx-3">
                    <div class="col-md-12">
                        <h2>Personal Information</br></h2>
                        <h6><span class="fw-bold text-primary">Request ID:</span> '.$row['id'].'</br></h6>
                        <h6><span class="fw-bold">Name:</br></span> '.$row['fullname'].'</br></h6>
                        <h6><span class="fw-bold">Email Address:</br></span> '.$row['email'].'</br></h6>
                        <h6><span class="fw-bold">Contact Number:</br></span> '.$row['phone'].'</br></h6>
                        <h6><span class="fw-bold">Address:</br></span> '.$row['address'].'</br></h6>
                        <h6><span class="fw-bold">Gender:</br></span> '.$row['gender'].'</br></h6>
                        <h6><span class="fw-bold">Religion:</br></span> '.$row['religion'].'</br></h6>
                        <h6><span class="fw-bold">Citizenship:</br></span> '.$row['citizenship'].'</br></h6>
                        <h6><span class="fw-bold">Date of Birth:</br></span> '.$row['dob'].'</br></h6>
                        <h6><span class="fw-bold">Age:</br></span> '.$row['age'].'</br></br></h6>
                        <hr></hr>
                        <h2>Questions</br></h2>
                        <h6><span class="fw-bold text-success">Are you willing to provide a loving and stable home environment for the child?</br></span> '.$row['question1'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Are you willing to provide financial and emotional support to the child?</br></span> '.$row['question2'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Why do you want to adopt?</br></br></span> '.$row['reason'].'</h6>
                        <h6><span class="fw-bold text-success">Do you have any previous experience with adoption or fostering?</br></br></span> '.$row['experience'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What kind of support system do you have in place for the child?</br></br></span> '.$row['support'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your plans and expectations for the child`s future?</br></br></span> '.$row['plans'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your expectations from AdoptAbility Foundation?</br></br></span> '.$row['expectations'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Any additional message you would like to add?</br></br></span> '.$row['message'].'</br></br></h6>
                    </div>
                </div>
            ';
        }
    } else {
        
    }
}

if (isset($_POST['click_view_request_btn'])) {
    $id = $_POST['view_request_id'];

    $sql = "SELECT * FROM released_requests WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="row my-2 mx-3">
                    <div class="col-md-12">
                        <h2>Personal Information</br></h2>
                        <h6><span class="fw-bold text-primary">Request ID:</span> '.$row['id'].'</br></h6>
                        <h6><span class="fw-bold">Name:</br></span> '.$row['fullname'].'</br></h6>
                        <h6><span class="fw-bold">Email Address:</br></span> '.$row['email'].'</br></h6>
                        <h6><span class="fw-bold">Contact Number:</br></span> '.$row['phone'].'</br></h6>
                        <h6><span class="fw-bold">Address:</br></span> '.$row['address'].'</br></h6>
                        <h6><span class="fw-bold">Gender:</br></span> '.$row['gender'].'</br></h6>
                        <h6><span class="fw-bold">Religion:</br></span> '.$row['religion'].'</br></h6>
                        <h6><span class="fw-bold">Citizenship:</br></span> '.$row['citizenship'].'</br></h6>
                        <h6><span class="fw-bold">Date of Birth:</br></span> '.$row['dob'].'</br></h6>
                        <h6><span class="fw-bold">Age:</br></span> '.$row['age'].'</br></br></h6>
                        <hr></hr>
                        <h2>Questions</br></h2>
                        <h6><span class="fw-bold text-success">Are you willing to provide a loving and stable home environment for the child?</br></span> '.$row['question1'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Are you willing to provide financial and emotional support to the child?</br></span> '.$row['question2'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Why do you want to adopt?</br></br></span> '.$row['reason'].'</h6>
                        <h6><span class="fw-bold text-success">Do you have any previous experience with adoption or fostering?</br></br></span> '.$row['experience'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What kind of support system do you have in place for the child?</br></br></span> '.$row['support'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your plans and expectations for the child`s future?</br></br></span> '.$row['plans'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">What are your expectations from AdoptAbility Foundation?</br></br></span> '.$row['expectations'].'</br></br></h6>
                        <h6><span class="fw-bold text-success">Any additional message you would like to add?</br></br></span> '.$row['message'].'</br></br></h6>
                    </div>
                </div>
            ';
        }
    } else {
        
    }
}
?>
