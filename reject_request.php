<?php
// Include database connection
require_once "db_conn.php";
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start session (if not already started)
session_start();

// Function to check if user is authenticated and is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin'; // Check if user is admin
}

// Check if user is authenticated as admin
if (!isAdmin()) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reject_request'])) {
    $requestId = $_POST['request_id'];

    // Fetch accepted request details from the accepted_requests table
    $fetchSql = "SELECT * FROM accepted_requests WHERE id = ?";
    $fetchStmt = $conn->prepare($fetchSql);
    $fetchStmt->bind_param("i", $requestId);
    $fetchStmt->execute();
    $requestData = $fetchStmt->get_result()->fetch_assoc();
    $fetchStmt->close();

    // Insert accepted request details back into the request table
    $insertSql = "INSERT INTO request (users_id, fullname, email, phone, address, gender, religion, citizenship, dob, age, occupation, income, question1, question2, reason, experience, support, plans, expectations, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);

    $status = 'Rejected'; // Set status to 'Rejected'

    $insertStmt->bind_param(
        "issssssssissssssssssss", 
        $requestData['users_id'], 
        $requestData['fullname'], 
        $requestData['email'], 
        $requestData['phone'], 
        $requestData['address'], 
        $requestData['gender'], 
        $requestData['religion'], 
        $requestData['citizenship'], 
        $requestData['dob'], 
        $requestData['age'], 
        $requestData['occupation'], 
        $requestData['income'], 
        $requestData['question1'], 
        $requestData['question2'], 
        $requestData['reason'], 
        $requestData['experience'], 
        $requestData['support'], 
        $requestData['plans'], 
        $requestData['expectations'], 
        $requestData['message'], 
        $status, // Use $status variable here
        $requestData['created_at']
    );

    if ($insertStmt->execute()) {
        // Delete the accepted request from the accepted_requests table
        $deleteSql = "DELETE FROM accepted_requests WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $requestId);
        $deleteStmt->execute();
        $deleteStmt->close();

        // Send rejection email
        try {
            // Load PHPMailer
            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'adoptabilityfoundation@gmail.com';
            $mail->Password   = 'ttfbglpquucwdwsy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom('adoptabilityfoundation@gmail.com', 'Adoptability Foundation');
            $mail->addAddress($requestData['email'], $requestData['fullname']); // Send to the user who registered
            $mail->addReplyTo('adoptabilityfoundation@gmail.com', 'Adoptability Foundation');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Request Rejected';
            $mail->Body    = 'Dear ' . $requestData['fullname'] . ',<br><br>Your request has been rejected.<br><br>We regret to inform you that your adoption request has been rejected by AdoptAbility Foundation. Please feel free to contact us if you have any questions.<br><br>Best regards,<br>Adoptability Foundation';

            // Send email
            $mail->send();

            // Set success message in session
            $_SESSION['success_message'] = "Request rejected successfully.";

            // Redirect to admin dashboard with a success message
            header("Location: admin_db.php");
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error moving request back: " . $insertStmt->error;
    }

    // Close statement and connection
    $insertStmt->close();
    $conn->close();
} else {
    // Redirect if accessed without proper post data
    header("Location: admin_db.php");
    exit();
}
?>