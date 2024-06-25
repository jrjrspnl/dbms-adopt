<?php
session_start();
require "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['Name']);
    $dateOfBirth = $_POST['DateOfBirth'];
    $gender = $conn->real_escape_string($_POST['Gender']);
    $dateOfAdmission = $_POST['DateOfAdmission'];
    $guardianCaregiver = $conn->real_escape_string($_POST['GuardianCaregiver']);
    $medicalInfo = $conn->real_escape_string($_POST['MedicalInformation']);
    $educationalStatus = $conn->real_escape_string($_POST['EducationalStatus']);
    $legalStatus = $conn->real_escape_string($_POST['LegalStatus']);
    $contactInfo = $conn->real_escape_string($_POST['ContactInformation']);
    $fosterParent = $conn->real_escape_string($_POST['FosterParent']);
    
    // Handle file upload
    $imagePath = null;
    if ($_FILES['ImageFile']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['ImageFile']['tmp_name'];
        $originalName = basename($_FILES['ImageFile']['name']);
        $targetPath = 'images/' . $originalName; // Adjust path as per your file structure

        // Move uploaded file to target directory
        if (move_uploaded_file($tempName, $targetPath)) {
            $imagePath = $conn->real_escape_string($targetPath);
        } else {
            echo "Error uploading file.";
            exit; // Exit script if file upload fails
        }
    }
    
    // SQL query to insert data
    $sql = "INSERT INTO Orphanage (Name, DateOfBirth, Gender, DateOfAdmission, GuardianCaregiver, MedicalInformation, EducationalStatus, LegalStatus, ContactInformation, FosterParent, ImagePath) 
            VALUES ('$name', '$dateOfBirth', '$gender', '$dateOfAdmission', '$guardianCaregiver', '$medicalInfo', '$educationalStatus', '$legalStatus', '$contactInfo', '$fosterParent', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Child added successfully";
    } else {
        echo "Error: Unable to add child.";
        // Log the error instead of echoing $conn->error directly to the user
    }
}

// Close connection
$conn->close();
?>
