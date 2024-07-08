<?php
use PHPMailer\PHPMailer\PHPMailer;

session_start();
include "../db_conn.php";

function sendemail_verify($name, $email, $verify_token) {
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    try {
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
        $mail->addAddress($email); // Send to the user who registered

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from Adoptability Foundation';
        $mail->Body    = "<h2>You have registered with Adoptability Foundation</h2>
                          <h5>Verify your email address to login with the below given link</h5>
                          <br/><br/>
                          <a href='http://localhost/dbms/verify-email.php?token=$verify_token'>Click me </a>";

        // Send email
        $mail->send();
        $_SESSION['success_message'] = "Message sent successfully."; // Set success message in session
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['gender'], $_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $name = test_input($_POST['name']);
    $lastname = test_input($_POST['lastname']);
    $email = strtolower(test_input($_POST['email']));  // Convert to lowercase
    $gender = test_input($_POST['gender']);
    $username = strtolower(test_input($_POST['username']));  // Convert to lowercase
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirm_password']);
    $verify_token = md5(uniqid()); // Generate a unique verification token
    
    // Validate inputs
    if (empty($name) || empty($lastname) || empty($email) || empty($gender) || empty($username) || empty($password) || empty($confirm_password)) {
        header("Location: ../register.php?error=All fields are required");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=A valid email is required");
        exit();
    } elseif ($password !== $confirm_password) {
        header("Location: ../register.php?error=Passwords do not match");
        exit();
    } elseif (strlen($password) < 8 || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $password)) {
        header("Location: ../register.php?error=Password must be 8 characters or more, with at least one letter and one number");
        exit();
    }

    // Hash password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../register.php?error=Username or Email is already taken");
        exit();
    }

    // Insert user into database
    $sql2 = "INSERT INTO users (name, lastname, email, gender, username, password, role, verify_token, verify_status) 
         VALUES (?, ?, ?, ?, ?, ?, 'user', ?, '0')";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "sssssss", $name, $lastname, $email, $gender, $username, $password_hash, $verify_token);

    if (mysqli_stmt_execute($stmt2)) {
        sendemail_verify($name, $email, $verify_token);
        header("Location: ../register.php?success=Account created successfully! Please verify your Email Address.");
        exit();
    } else {
        header("Location: ../register.php?error=Unknown error occurred");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);
} else {
    header("Location: ../register.php?error=All fields are required");
    exit();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
