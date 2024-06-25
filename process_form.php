<?php
// Include database connection
require_once "db_conn.php";
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start session (if not already started)
session_start();

// Function to check if user is authenticated
function isAuthenticated() {
    return isset($_SESSION['id']); // Check if user ID session variable is set
}

// Check if user is authenticated
if (!isAuthenticated()) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data (sanitize if necessary)
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $occupation = $_POST['occupation'];
    $income = $_POST['income'];
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $reason = $_POST['reason'];
    $experience = $_POST['experience'];
    $support = $_POST['support'];
    $plans = $_POST['plans'];
    $expectations = $_POST['expectations'];
    $message = $_POST['message'];
    
    $userId = $_SESSION['id']; // Get the user ID from the session

    // Prepare and bind SQL statement to insert request data
    $sql = "INSERT INTO request (fullname, email, phone, address, gender, religion, citizenship, dob, age, occupation, income, question1, question2, reason, experience, support, plans, expectations, message, users_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssisdssssssssi", $fullname, $email, $phone, $address, $gender, $religion, $citizenship, $dob, $age, $occupation, $income, $question1, $question2, $reason, $experience, $support, $plans, $expectations, $message, $userId);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Update registered status in users table
        $updateSql = "UPDATE users SET registered = 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $userId);
        $updateStmt->execute();
        $updateStmt->close();

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
            $mail->addAddress($email, $fullname); // Send to the user who registered
            $mail->addReplyTo('adoptabilityfoundation@gmail.com', 'Adoptability Foundation');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Confirmation';
            $mail->Body    = 'Dear ' . $fullname . ',<br><br>Your registration data has been submitted successfully.<br><br>Your information has been received and will be reviewed by our team. We appreciate your interest in our cause. If you have any questions in the meantime, please feel free to contact us.<br><br>Best regards,<br>Adoptability Foundation';

            // Send email
            $mail->send();
            $_SESSION['success_message'] = "Registration data submitted successfully."; // Set success message in session
            header("Location: request.php"); // Redirect to request.php (to show success message)
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        // Log the error or show an appropriate message to the user
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
