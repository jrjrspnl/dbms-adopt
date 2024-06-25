<?php

session_start();

include "../db_conn.php";

if (isset($_POST['name']) || isset($_POST['lastname']) || isset($_POST['email']) ||
    isset($_POST['gender']) || isset($_POST['username']) || isset($_POST['password']) || isset($_POST['confirm_password'])) {

    $filledCount = 0;
    $fields = ['name', 'lastname', 'email', 'gender', 'username', 'password', 'confirm_password'];

    foreach ($fields as $field) {
        if (!empty($_POST[$field])) {
            $filledCount++;
        }
    }

    if ($filledCount === 0) {
        // Redirect with error message
        header("Location: ../register.php?error=All fields are required");
        exit();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = test_input($_POST['name']);
    $lastname = test_input($_POST['lastname']);
    $email = strtolower(test_input($_POST['email']));  // Convert to lowercase
    $gender = test_input($_POST['gender']);
    $username = strtolower(test_input($_POST['username']));  // Convert to lowercase
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirm_password']);
    
    // Check if email is provided and validate it
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=A valid email is required");
        exit();
    }

    if (empty($name) || empty($lastname) || empty($email) ||
        empty($gender) || empty($username) || empty($password) ||
        empty($confirm_password)) {
        // Redirect with error message
        header("Location: ../register.php?error=All fields are required");
        exit();
    } else if ($password !== $confirm_password) {
        header("Location: ../register.php?error=Passwords do not match");
        exit();
    } else if (strlen($password) < 8 || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $password)) {
        header("Location: ../register.php?error=Password must be 8 characters or more, with at least one letter and one number");
        exit();
    } else {
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: ../register.php?error=Username is already taken");
            exit();
        } else {
            $sql2 = "INSERT INTO users(name, lastname, email, gender, username, password, role) 
                     VALUES('$name', '$lastname', '$email', '$gender', '$username', '$password', 'user')";
            if (mysqli_query($conn, $sql2)) {
                header("Location: ../register.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: ../register.php?error=Unknown error occurred");
                exit();
            }
        }
    }
} else {
    header("Location: ../register.php");
    exit();
}
?>
