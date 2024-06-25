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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accept_request'])) {
    $requestId = $_POST['request_id'];

    // Fetch request details from the database
    $fetchSql = "SELECT *, 'Accepted' as status FROM request WHERE id = ?";
    $fetchStmt = $conn->prepare($fetchSql);
    $fetchStmt->bind_param("i", $requestId);
    $fetchStmt->execute();
    $requestData = $fetchStmt->get_result()->fetch_assoc();
    $fetchStmt->close();
    

    // Insert request details into the accepted_requests table
    $insertSql = "INSERT INTO accepted_requests (id, users_id, fullname, email, phone, address, gender, religion, citizenship, dob, age, occupation, income, question1, question2, reason, experience, support, plans, expectations, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insertStmt = $conn->prepare($insertSql);

        $insertStmt->bind_param(
            "iissssssssissssssssssss", 
            $requestData['id'], 
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
            $requestData['status'],
            $requestData['created_at']
        );
        
    
    if ($insertStmt->execute()) {
        // Delete the request from the original table
        $deleteSql = "DELETE FROM request WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $requestId);
        $deleteStmt->execute();
        $deleteStmt->close();
        

        // Send email notification
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
            $mail->Subject = 'Request Accepted';
            $mail->Body    = 'Dear ' . $requestData['fullname'] . ',<br><br>Your request has been accepted.<br><br>We are pleased to inform you that your adoption request has been accepted by AdoptAbility Foundation. Please check your email for further instructions on what documents to prepare before your visit to the orphanage.<br>
            <br>Keep an eye on your inbox for the scheduled date and time of your visit. We look forward to welcoming you!<br><br>Before your visit to the orphanage, please ensure you have printed the required form.Please bring this form with you during your visit to facilitate the adoption process.<br><br>If you have any questions in the meantime, please feel free to contact us.<br><br>Best regards,<br>Adoptability Foundation';

            // Send email
            $mail->send();

            $_SESSION['success_message'] = "Request accepted successfully."; // Set success message in session
            header("Location: admin_db.php"); // Redirect to admin dashboard (to show success message)
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error moving request: " . $insertStmt->error;
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