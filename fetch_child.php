<?php
require "db_conn.php"; // Include your database connection script

// Query to fetch all children information
$sql = "SELECT ChildID, Name, DateOfBirth, Gender, DateOfAdmission, GuardianCaregiver, MedicalInformation, EducationalStatus, SocialWorkerCaseManager, LegalStatus, ContactInformation, FosterParent FROM orphanage";

// Perform the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Array to hold JSON response
    $response = array();

    // Fetch rows and add to response array
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    // Convert array to JSON and output
    echo json_encode($response);
} else {
    echo "No children found";
}

// Close connection
$conn->close();
?>
