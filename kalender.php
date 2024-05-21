<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php include('header.php'); ?>

<body class="calendar-page">
<div class="calendar">
    <div class="month">
        <div class="prev" onclick="prevMonth()">&#10094;</div>
        <div class="month-name"></div>
        <div class="next" onclick="nextMonth()">&#10095;</div>
    </div>
    <div class="weekdays">
        <div>Zo</div>
        <div>Ma</div>
        <div>Di</div>
        <div>Wo</div>
        <div>Do</div>
        <div>Vr</div>
        <div>Za</div>
    </div>
    <div class="days"></div>
</div>
<div class="beeld">
    <img src="images/zomer.webp" alt="afbeelding">
</div>
<script src="script.js"></script>
</body>
</html>
