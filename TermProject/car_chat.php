<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";


$conn = new mysqli($servername, $username, $password, $dbname);

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
            background-color: rgba(0, 0, 0, 0.6);
            display:inline-block;
        }
        p{
            background-color: rgba(0,0,0,0.6);
        }
        .c { font-family: sans-serif; }
        div{
            background-color: white;
            background-size : cover;
        }
    </style>
</head>
<body>";


$sql = "select Name from User where Status='online'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$name = $row['Name'];
$id = $_POST['roomid'];
echo "<br>";

echo "<span style='text - align: left'><font class='c' color='white' size='5'>Message </font></span><br>";

echo "<form method='post'><action='car_chat.php'>";
echo "<textarea name='context' cols='100' rows='3'></textarea> <br>";
echo "<input type='hidden' name='roomid' value='$id'>";
echo "<input type='submit' value='Send'>";
echo "<br>";
echo "<a href='mypage.php'><input type='button' value='go to mypage'></a>";
echo "<a href='main.html'><input type='button' value='go to mainpage'></a>";
$context = $_POST['context'];
$id = $_POST['roomid'];

echo "<br>";
echo "<br>";
echo "<br>";

$sql = "insert into Carpool_Chat (context, speaker, Carpool_Room_RoomId) values ('{$context}','{$name}','{$id}')";
mysqli_query($conn,$sql);

echo "<span style='text - align: left'><font class='c' color='white' size='5'> Chat </font></span><br><br>";
echo "<div>";
$sql = "select context, speaker from Carpool_Chat where Carpool_Room_RoomId='$id'";
$res = mysqli_query($conn, $sql);
while ($row=mysqli_fetch_array($res)){
    if(!($row['context'] == '')){
        echo "<font class='c' color='Black' size='3'>".$row['speaker']. " : </font>";
        echo "<font class='c' color='Black' size='3'>".$row['context']. "  </font>";
        echo "<br>";
    }
}
echo "</div>";