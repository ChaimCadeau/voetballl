<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['submit'])) {
        $gmail = $_POST['mail'];
        $password = $_POST['pass'];

        if (!empty($gmail) && filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM voetballl WHERE email = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $gmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);


                if ($user_data['activated'] == 1) {
                    if (password_verify($password, $user_data['pass'])) {
                        $_SESSION['user_id'] = $user_data['id'];
                        $_SESSION['user_email'] = $user_data['email'];
                        header("location: memberpage.php");
                        exit();
                    } else {
                        echo "<script type='text/javascript'> alert('Wrong Username or password')</script>";
                    }
                } else {
                    echo "<script type='text/javascript'> alert('Account not activated. Please check your email for activation instructions.')</script>";
                }
            } else {
                echo "<script type='text/javascript'> alert('Account not found. Please sign up.')</script>";
            }
        }
    }
}
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login en Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <form method="POST">
        <label>Email</label>
        <label>
            <input type="email" name="mail" required>
        </label>
        <label>Password</label>
        <label>
            <input type="password" name="pass" required>
        </label>
        <input type="submit" name="submit" value="Submit">
    </form>
    <p> Don't have an account? <a href="signup.php">Sign Up here</a></p>
</div>
</body>
</html>
