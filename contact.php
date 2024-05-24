<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>

<div class="footo">
    <img src="images/contact.png" alt="contact">
</div>

<div class="custom-container">
    <div class="custom-left-panel">
        <h2>Contact us</h2>
    </div>

    <div class="custom-right-panel">
        <form action="mailto:c.cadeau@outlook.com" method="post" enctype="text/plain">
            <div class="custom-form-group">
                <label for="naam"></label><input type="text" id="naam" name="naam" placeholder="Enter your Name" required>
            </div>
            <div class="custom-form-group">
                <label for="email"></label><input type="email" id="email" name="email" placeholder="Enter a valid email address" required>
            </div>
            <div class="custom-form-group">
                <label for="bericht"></label><textarea id="bericht" name="bericht" rows="4" placeholder="Enter your message" required></textarea>
            </div>
            <div class="custom-form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>
