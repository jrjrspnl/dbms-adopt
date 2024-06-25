<?php
require "db_conn.php";

header('Content-Type: application/json');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Step 3: Retrieve data from $_POST
    $childID = $_POST['editChildID'];
    // Assuming editImageFile is for image upload, handle it appropriately if included
    // $imageFile = $_FILES['editImageFile']; // Example for handling image upload
    
    $childName = $_POST['Name'];
    $dateOfBirth = $_POST['DateOfBirth'];
    $gender = $_POST['Gender'];
    $dateOfAdmission = $_POST['DateOfAdmission'];
    $guardianCaregiver = $_POST['GuardianCaregiver'];
    $medicalInfo = $_POST['MedicalInformation'];
    $educationStatus = $_POST['EducationalStatus'];
    $legalStatus = $_POST['LegalStatus'];
    $contactInfo = $_POST['ContactInformation'];
    $fosterParent = $_POST['FosterParent'];

    $sql = "UPDATE orphanage SET 
                Name = '$childName',
                DateOfBirth = '$dateOfBirth',
                Gender = '$gender',
                DateOfAdmission = '$dateOfAdmission',
                GuardianCaregiver = '$guardianCaregiver',
                MedicalInformation = '$medicalInfo',
                EducationalStatus = '$educationStatus',
                LegalStatus = '$legalStatus',
                ContactInformation = '$contactInfo',
                FosterParent = '$fosterParent'
            WHERE ChildID = $childID";

    if (mysqli_query($conn, $sql)) {
        $response['success'] = true;
        $response['message'] = 'Record updated successfully.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error updating record: ' . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    $response['success'] = false;
    $response['message'] = 'Form submission error.';
}

echo json_encode($response);
?>