<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "update User SET Status = 'offline' WHERE Status = 'online'";
mysqli_query($conn,$sql);

echo"<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>MyPage</title>
    <style>
        body{
            background-image:url('/TermProject/Background.png');
            background-repeat: no-repeat;
            background-position: left top;
            background-size: cover;
        }
        span{
        }
        .c { font-family: sans-serif; }
    </style>
</head>
<body>";

echo "<span><font class=\"c\" color=\"white\" size=\"6\"> Logout! </font></span><br>";
echo "<a href='main_before_login.html'><input type='button' value='Go to home'></a>";
?>


