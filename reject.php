<?php
require 'db_conn.php'; // Include your database connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestId = intval($_POST['request_id']);

    // Update request status to 'Rejected'
    $sql = "UPDATE request SET status = 'Rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $requestId);

    if ($stmt->execute()) {
        // Fetch the user details to send the email
        $fetchSql = "SELECT fullname, email FROM request WHERE id = ?";
        $fetchStmt = $conn->prepare($fetchSql);
        $fetchStmt->bind_param('i', $requestId);
        $fetchStmt->execute();
        $userData = $fetchStmt->get_result()->fetch_assoc();
        $fetchStmt->close();

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
            $mail->addAddress($userData['email'], $userData['fullname']); // Send to the user who registered
            $mail->addReplyTo('adoptabilityfoundation@gmail.com', 'Adoptability Foundation');
            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Request Rejected';
            $mail->Body    = 'Dear ' . $userData['fullname'] . ',<br><br>Your request has been rejected.<br><br>We regret to inform you that your adoption request has been rejected by AdoptAbility Foundation. Please feel free to contact us if you have any questions.<br><br>Best regards,<br>Adoptability Foundation';

            // Send email
            $mail->send();

            echo 'success';
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>