<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$name = $_POST['name'];
$id = $_POST['userid'];
$pw = $_POST['password'];
$phone = $_POST['Phone'];
$account = $_POST['Account'];
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
if($conn->connect_error){
    die("connection failed: ". $conn->connect_error);
}

$sql = "insert into User (UserID, Name, Phone, Account, Password) values ('{$id}','{$name}','{$phone}','{$account}','{$pw}')";

echo "<span style='text-align: center'><font class='c' color='white' size='5'>Register Finished!</font></span><br>";

echo "<a href='main_before_login.html'><input type='button' value='Mainpage'></a>";
echo "<a href='log_in.html'><input type='button' value='Log in'></a>";

mysqli_query($conn,$sql);

?>