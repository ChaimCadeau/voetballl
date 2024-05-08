<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['activate'])) {
    $activation_code = $_POST['activation_code'];

    $query = "SELECT * FROM voetballl WHERE verification_code = ? AND activated = 0";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $activation_code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {

                $query = "UPDATE voetballl SET activated = 1 WHERE verification_code = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "s", $activation_code);
                mysqli_stmt_execute($stmt);


                header("Location: login.php");
                exit();
            } else {
                $error_message = "Ongeldige activatiecode.";
            }
        } else {
            echo "Fout bij het verkrijgen van het resultaat: " . mysqli_error($con);
        }
    } else {
        echo "Fout bij het voorbereiden van de query: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activate Your Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="activation">
    <h1>Activate Your Account</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <p>You are almost done. An email has been sent to your email account. Enter your activation code below.</p>
    <form method="POST">
        <label>Activation Code</label>
        <label>
            <input type="text" name="activation_code" required>
        </label>
        <input type="submit" name="activate" value="Activate">
    </form>
</div>
</body>
</html>
