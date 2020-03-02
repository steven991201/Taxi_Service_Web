<?php

$logid = $_POST['log_id'];
$logpw = $_POST['log_pw'];

$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "select UserId from User";

$res = mysqli_query($conn,$sql);
$list = array();
$i = 0;

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

if ($res->num_rows>0){
    while ($row=mysqli_fetch_array($res)){
        $list[$i] = $row['UserId'];
        $i += 1;
    }
    if (!(in_array($logid, $list))){
        echo "<span style='text-align: center'><font class='c' color='white' size='5'>Check your ID again</font></span><br>";
        echo "<a href='log_in.html'><input type='button' value='Retry'></a>";
    }
    else{
        $sql = "select Password from User where UserId='$logid'";
        $pw = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($pw);
        $realpw = $row['Password'];

        if ($realpw == $logpw){
            echo "<span style='text-align: center'><font class='c' color='white' size='5'>Log in successed!</font></span><br>";
            echo "<a href='main.html'><input type='button' value='Go to home'></a>";
            $sql = "update User SET Status = 'online' WHERE UserId = '$logid'";
            mysqli_query($conn,$sql);
            }
            else{
                echo "<span style='text-align: center'><font class='c' color='white' size='5'>Check your password again</font></span><br>";
                echo "<a href='log_in.html'><input type='button' value='Retry'></a>";
            }
        }
    }


else{
    echo "<span style='text-align: center'><font class='c' color='white' size='5'>Check your ID again</font></span><br>";
    echo "<a href='log_in.html'><input type='button' value='Retry'></a>";
}
echo "</body>
</html>";
