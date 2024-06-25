<?php
// Assuming $conn is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['release_id'])) {
    $release_id = $_POST['release_id'];

    // Retrieve the record from accepted_requests
    $select_sql = "SELECT * FROM accepted_requests WHERE id = $release_id";
    $result = mysqli_query($conn, $select_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert the record into released_requests
        $insert_sql = "INSERT INTO released_requests (users_id, fullname, email, phone, address, gender, religion, citizenship, dob, age, occupation, income, question1, question2, reason, experience, support, plans, expectations, message, created_at)
                       VALUES ('{$row['users_id']}', '{$row['fullname']}', '{$row['email']}', '{$row['phone']}', '{$row['address']}', '{$row['gender']}', '{$row['religion']}', '{$row['citizenship']}', '{$row['dob']}', '{$row['age']}', '{$row['occupation']}', '{$row['income']}', '{$row['question1']}', '{$row['question2']}', '{$row['reason']}', '{$row['experience']}', '{$row['support']}', '{$row['plans']}', '{$row['expectations']}', '{$row['message']}', '{$row['created_at']}')";
        
        if (mysqli_query($conn, $insert_sql)) {
            // Successfully moved to released_requests, now delete from accepted_requests
            $delete_sql = "DELETE FROM accepted_requests WHERE id = $release_id";
            if (mysqli_query($conn, $delete_sql)) {
                // Record deleted successfully
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    } else {
        echo "Record not found";
    }
}

// Close database connection
mysqli_close($conn);
?>
