<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Timer</title>
    <link rel="stylesheet" href="style.css">
    <?php include('header.php'); ?>
</head>
<body
        class="timer-page">
<div class="container">
    <div class="timer">
        <h2>Timer</h2>
        <div class="time" id="timer">00:00:00</div>
        <button onclick="startTimer()">Start</button>
        <button onclick="stopTimer()">Stop</button>
        <button onclick="resetTimer()">Reset</button>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
