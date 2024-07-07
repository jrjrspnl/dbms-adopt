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
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM users WHERE username=? AND role=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                if ($row['verify_status'] === 1) {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['username'] = $row['username'];

                    // Set a cookie to maintain login state
                    setcookie('loggedIn', 'true', time() + (86400 * 30), "/"); // 86400 = 1 day

                    // Redirect to the appropriate dashboard based on the role
                    if ($role === "admin") {
                        header("Location: ../admin_db.php");
                        exit();
                    } elseif ($role === "user") {
                        header("Location: ../user_db.php");
                        exit();
                    }
                } else {
                    header("Location: ../login.php?error=Please verify your Email Address to login");
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
