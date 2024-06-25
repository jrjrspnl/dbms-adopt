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

// Check if form is submitted and request_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['release_request'])) {
    $requestId = $_POST['request_id'];

    // Fetch request details from the accepted_requests table
    $fetchSql = "SELECT *, 'Released' as process FROM accepted_requests WHERE id = ?";
    $fetchStmt = $conn->prepare($fetchSql);
    $fetchStmt->bind_param("i", $requestId);
    $fetchStmt->execute();
    $result = $fetchStmt->get_result();

    if ($result->num_rows > 0) {
        $requestData = $result->fetch_assoc();

        // Prepare INSERT statement for released_requests table
        $insertSql = "INSERT INTO released_requests 
                      (id, users_id, fullname, email, phone, address, gender, religion, citizenship, dob, age, occupation, income, question1, question2, reason, experience, support, plans, expectations, message, created_at, process) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $insertStmt = $conn->prepare($insertSql);

        // Bind parameters
        $insertStmt->bind_param("iissssssssissssssssssss", 
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
            $requestData['created_at'],
            $requestData['process']
        );
        
        // Execute the INSERT statement
        if ($insertStmt->execute()) {
            // Delete the request from accepted_requests table
            $deleteSql = "DELETE FROM accepted_requests WHERE id = ?";
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
                $mail->Subject = 'Adoption Finalized';
                $mail->Body    = '<p>Dear ' . $requestData['fullname'] . ',</p>
                <p>Congratulations!</p>
                <p>We are pleased to inform you that the adoption process through AdoptAbility Foundation has been successfully completed.</p>
                <p>Your decision to adopt has made a profound impact on a child\'s life, providing them with a loving home and bright future.</p>
                <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
                <br>
                <p>Best regards,</p>
                <p>Adoptability Foundation</p>';


                // Send email
                $mail->send();

                $_SESSION['success_message'] = "Adoption finalized successfully."; // Set success message in session
                header("Location: admin_db.php"); // Redirect to admin dashboard (to show success message)
                exit();
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error inserting data: " . $insertStmt->error;
        }

        // Close statement and connection
        $insertStmt->close();
    } else {
        echo "Request not found.";
    }

    // Close statement and connection
    $fetchStmt->close();
    $conn->close();
} else {
    // Redirect if accessed without proper post data
    header("Location: admin_db.php");
    exit();
}
?>
