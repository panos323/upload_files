<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX PHP</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!--sinple ajax-->
    <!--
    <div class="form">
        <input type="text" id="first_name" name="" placeholder="first name"><br>
        <input type="text" id="last_name" name="" placeholder="last name"><br>
        <input type="text" id="code" name="" placeholder="code"><br>
        <button class="sumbitBtn" name="sumbitBtn">Send</button>
    </div>
    -->


    <!--ajax with upload image-->
    <form enctype="multipart/form-data" id="fupForm" >
        <input type="text" id="first_name" name="first_name" placeholder="first name" required><br>
        <input type="text" id="last_name" name="last_name" placeholder="last name" required><br>
        <input type="text" id="code" name="code" placeholder="code" required><br>
        <input type="file" accept="image/*" capture="camera" id="file" name="file" required> <br>
        <input type="submit" name="submit" class="submitBtn" value="Submit"/>
    </form>
    

<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>