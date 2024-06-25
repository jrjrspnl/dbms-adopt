<?php
require "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['childID'])) {
    $childID = $_POST['childID'];

    // Perform SQL to move child data to adopted_children table
    $moveSQL = "INSERT INTO adopted_children (ChildID, Name, DateOfBirth, Gender, DateOfAdmission, GuardianCaregiver, MedicalInformation, EducationalStatus, LegalStatus, ContactInformation, FosterParent, ImagePath)
            SELECT ChildID, Name, DateOfBirth, Gender, DateOfAdmission, GuardianCaregiver, MedicalInformation, EducationalStatus, LegalStatus, ContactInformation, FosterParent, ImagePath
            FROM orphanage
            WHERE ChildID = $childID";


    if (mysqli_query($conn, $moveSQL)) {
        // If move was successful, delete from orphanage table
        $deleteSQL = "DELETE FROM orphanage WHERE ChildID = $childID";
        if (mysqli_query($conn, $deleteSQL)) {
            echo "Child adopted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close database connection
mysqli_close($conn);
?>
