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
<body class="member-page">
<div class="black-box">
    <?php if(isset($user_name)) : ?>
        <h1>Welcome: <?php echo $user_name; ?></h1>
        <p>Dit is the memberpage. <br> Vanaf deze pagina is het mogelijk gebruik te maken van de bestaande functionaliteiten.</p>
    <?php endif; ?>

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
    <a href="bal.php" class="box6-link">
        <i class="fas fa-futbol"></i>
        <span>Bal</span>
    </a>
    <a href="timer.php" class="box7-link">
        <i class="fas fa-clock"></i>
        <span>Timer</span>
    </a>
    <a href="contract" class="box8-link">
        <i class="fas fa-file-signature"></i>
        <span>Papier</span>
    </a>
    <a href="instelling.php" class="box9-link">
        <i class="fas fa-cog"></i>
        <span>Instellingen</span>
    </a>

</div>

</body>
</html>

