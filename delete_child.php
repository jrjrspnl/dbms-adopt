<?php
require "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $childID = $_POST['childID'];
    
    // Perform deletion query
    $sql = "DELETE FROM orphanage WHERE ChildID = '$childID'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    // Close database connection
    mysqli_close($conn);
}
?>
