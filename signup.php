<?php
session_start();
include("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['submit'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $gmail = $_POST['mail'];
        $password = $_POST['pass'];

        if (!empty($gmail) && filter_var($gmail, FILTER_VALIDATE_EMAIL)) {

            $query = "SELECT * FROM voetballl WHERE email = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $gmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0) {
                echo "<script type='text/javascript'> alert('Email already exists.')</script>";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $verification_code = mt_rand(10000, 99999);

                $query = "INSERT INTO voetballl (fname, lname, email, pass, verification_code) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $gmail, $hashed_password, $verification_code);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'clipsbygoat@gmail.com';
                        $mail->Password   = 'fmjuoaziowqjnpst';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;

                        $mail->setFrom('clipsbygoat@gmail.com', 'Mailer');
                        $mail->addAddress($gmail, $firstname . ' ' . $lastname);

                        $mail->isHTML();
                        $mail->Subject = 'Registratie Verificatiecode';
                        $mail->Body    = "Uw verificatiecode is: $verification_code";

                        $mail->send();
                        header('Location: active.php');
                        exit;
                    } catch (Exception $e) {
                        echo "<script type='text/javascript'> alert('Failed to send verification email.')</script>";
                    }
                }
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
<div class="signup">
    <h1>Sign Up</h1>
    <h4>No Account SIGN UP</h4>
    <form method="POST">
        <label> First Name</label>
        <label>
            <input type="text" name="fname" required>
        </label>
        <label> last Name</label>
        <label>
            <input type="text" name="lname" required>
        </label>
        <label> Email</label>
        <label>
            <input type="email" name="mail" required>
        </label>
        <label> Password</label>
        <label>
            <input type="password" name="pass" required>
        </label>
        <input type="submit" name="submit" value="Submit">
    </form>
    <p> Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
