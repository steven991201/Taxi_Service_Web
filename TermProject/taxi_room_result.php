<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$departure = $_POST['departure'];
$arrival = $_POST['arrival'];
$day = $_POST['day'];
$hour = $_POST['hour'];
$minute = $_POST['minute'];
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

echo "<span style='text-align: center'><font class='c' color='white' size='5'>Successfully made the room!!</font></span><br>";
echo "<span style='text-align: center'><font class='c' color='white' size='5'>Your departure point is $departure</font></span><br>";
echo "<span style='text-align: center'><font class='c' color='white' size='5'>Your arrival point is $arrival</font></span><br>";
echo "<span style='text-align: center'><font class='c' color='white' size='5'>Your departure day is $day, departure time is $hour : $minute</font></span><br>";

echo "<a href='main.html'><input type='button' value='Go to home'></a>";

$sql = "select UserId from User where Status='online'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$user = $row['UserId'];

date_default_timezone_set('Asia/Seoul');
$nTimeNow = time();
$now = (int)$nTimeNow;

$sql = "insert into Taxi_Host (TimeStamp, User_UserId) values ( $now,'$user')";

mysqli_query($conn, $sql);


$str_d = (string)$day;
$str_h = (string)$hour;
$str_m = (string)$minute;
$gn = 1;

$time = $str_d.$str_h.$str_m;

$sql = "select hostId from Taxi_Host where User_UserId='$user'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$id = $row['hostId'];

$sql = "insert into Taxi_Room (Departure, Arrival, Time, GN, Taxi_Host_hostId) values ('{$departure}','{$arrival}','{$time}','{$gn}', '{$id}')";

mysqli_query($conn,$sql);


