<?php
session_start();
include("db.php");


if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT fname FROM voetballl WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if ($result && $user_data = mysqli_fetch_assoc($result)) {
    $user_name = $user_data['fname'];
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MemberPage</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
</head>
<body>

<?php include('header.php'); ?>

<div class="black-box">
    <?php if(isset($user_name)) : ?>
        <h1>Welcome: <?php echo $user_name; ?></h1>
        <p>Here is the member page. <br>
            From this page, it is possible to utilize the existing functionalities.</p>
    <?php endif; ?>

    <body class="member-page">


    <a href="staf.php" class="box1-link">
        <i class="far fa-user-circle"></i>
        <span>Staf</span>
    </a>
    <a href="spelerslijst.php" class="box2-link">
        <i class="fas fa-list"></i>
        <span>Spelerslijst</span>
    </a>
    <a href="tactiek.php" class="box3-link">
        <i class="fas fa-users"></i>
        <span>Tactiek</span>
    </a>
    <a href="trofee.php" class="box4-link">
        <i class="fas fa-trophy"></i>
        <span>Trofee</span>
    </a>
    <a href="kalender.php" class="box5-link">
        <i class="fas fa-calendar"></i>
        <span>Kalender</span>
    </a>
    <a href="timerr.php" class="box6-link">
        <i class="fas fa-clock"></i>
        <span>Timer</span>
    </a>
</div>

</body>
</html>

