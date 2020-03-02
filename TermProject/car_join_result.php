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
    </style>
</head>
<body>";
$room = $_POST['num'];

$sql = "select RoomId from Carpool_Room";

$res = mysqli_query($conn, $sql);

$list = array();
$i = 0;

if ($res->num_rows>0){
    while ($row=mysqli_fetch_array($res)){
        $list[$i] = $row['RoomId'];
        $i += 1;
    }
    if (!(in_array($room,$list))){
        echo "<span style='text-align: center'><font class='c' color='white' size='4'>Invalid Room ID </font></span> <br>";
        echo "<span style='text-align: center'><font class='c' color='white' size='4'>Try again </font></span>  <br>";
        echo "<a href='car_join.php'><input type='button' value='Room list'></a>";
    }
    else{
        echo "<span style='text-align: center'><font class='c' color='white' size='4'>Join successed! </font></span>  <br>";
        echo "<span style='text-align: center'><font class='c' color='white' size='4'>You can check your room information at mypage </font></span>  <br>";
        echo "<a href='mypage.php'><input type='button' value='Mypage'></a>";
        echo "<a href='main.html'><input type='button' value='Go to home'></a>";

        $sql = "select UserId from User where Status='online'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $user = $row['UserId'];

        date_default_timezone_set('Asia/Seoul');
        $nTimeNow = time();
        $now = (int)$nTimeNow;

        $sql = "insert into Carpool_Guest (TimeStamp, User_UserId) values ('{$now}','{$user}')";

        mysqli_query($conn, $sql);

        $id = mysqli_insert_id($conn);


        $sql = "insert into Carpool_Join (Carpool_Guest_guestId, Carpool_Room_RoomId) values ('{$id}', '{$room}')";
        mysqli_query($conn, $sql);

        $sql = "select GN, MN from Carpool_Room where RoomId='$room'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $current = $row['GN'];
        $max = $row['MN'];

        $new = $current + 1;
        $sql = "UPDATE Carpool_Room SET GN='$new' where RoomId='$room'";
        mysqli_query($conn, $sql);


        if($new==$max){
            $sql = "UPDATE Carpool_Room SET Status='Closed' where RoomId='$room'";
            mysqli_query($conn, $sql);
        }

    }
}

else{
    echo "<span style='text-align: center'><font class='c' color='white' size='4'>No available room now! </font></span> <br>";
    echo "<span style='text-align: center'><font class='c' color='white' size='4'>Pleases visit later or make the room</font></span> <br>";
    echo "<a href='main.html'><input type='button' value='Go to home'></a>";
}