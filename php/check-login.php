<?php
session_start();
include "../db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);

    if (empty($username) || empty($password) || empty($role)) {
        header("Location: ../login.php?error=All fields are required");
        exit();
    } else {
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['role'] === $role) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];  // Store login ID
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];

                // Set a cookie to maintain login state
                setcookie('loggedIn', 'true', time() + (86400 * 30), "/"); // 86400 = 1 day

                // Redirect to the appropriate dashboard
                if ($role === "admin") {
                    header("Location: ../admin_db.php");
                    exit();
                } elseif ($role === "user") {
                    header("Location: ../user_db.php");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Incorrect Username or Password");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
