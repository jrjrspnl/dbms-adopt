<?php
session_start();
include('db_conn.php');

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Using prepared statements for security
    $stmt = $conn->prepare("SELECT verify_token, verify_status FROM users WHERE verify_token = ? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE users SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if($update_query_run) {
                $_SESSION['status'] = "Your account has been Verified Successfully";
                header("Location: login.php?success=Your account has been Verified Successfully");
                exit();
            } else {
                $_SESSION['status'] = "Verification Failed";
                header("Location: login.php?error=Verification Failed");
            }
        } else {
            $_SESSION['status'] = "Email already verified. Please Login";
            header("Location: login.php?info=Email already verified. Please Login");
        }
    } else {
        $_SESSION['status'] = "This token does not exist";
        header("Location: login.php?error=This token does not exist");
        exit();
    }
    
    $stmt->close();
} else {
    $_SESSION['status'] = "Not allowed";
    header("Location: login.php?error=Not allowed");
    exit();
}

$conn->close();
?>