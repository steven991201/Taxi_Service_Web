<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "Select UserId from User WHERE Status = 'online'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$user = $row['UserId'];

$a = 1;
$b = 1;
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
        .c { font-family: sans-serif; }
    </style>
</head>
<body>";
echo"<table><tr>";

$sql = "Select hostId from Taxi_Host WHERE User_UserId = '$user'";
$result = mysqli_query($conn,$sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $hostId = $row['hostId'];
        $sql = "Select * from User WHERE UserId = '$user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $account = $row['Account'];
        $Phone = $row['Phone'];
        echo "<td>
        <span style='text - align: left'><font class='c' color='white' size='7'>Taxi Room $a</font> </span><br>
        <span style='text-align: left'><font class='c' color='white' size='6'>Host</font></span><br>
        ";
        $sql = "Select * from Taxi_Room WHERE Taxi_Host_hostId = '$hostId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $roomId = $row1['RoomId'];
        echo"
        <span style='text-align: left'><font class='c' color='white' size='5'>Time : ".$row1['Time']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Departure : ".$row1['Departure']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Arrival : ".$row1['Arrival']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Number of Guest : ".$row1['GN']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Status : ".$row1['Status']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Account : $account</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Phone : $Phone</font></span><br>
        ";
        if($row1['Status'] == 'open'){
            echo "<form method = 'post'><button name = 'close'>close</button></form>";
            if(isset($_POST['close'])){
                $sql = "Update Taxi_Room Set Status = 'Closed' where Taxi_Host_hostId = '$hostId'";
                mysqli_query($conn, $sql);
            }
        }
        else{
            echo "<form method = 'post' action='taxi_chat_save.php'><input type = 'hidden' name = 'roomid' value = '$roomId'><input type='submit' value='chat'></form>";
        }
        echo "</td>";
        $a ++;
    }
}
$sql = "Select guestId from Taxi_Guest WHERE User_UserId = '$user'";
$result = mysqli_query($conn,$sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $guestId = $row['guestId'];
        echo "<td>
        <span style='text - align: left'><font class='c' color='white' size='7'>Taxi Room $a</font> </span><br>
        <span style='text-align: left'><font class='c' color='white' size='6'>Guest</font></span><br>
        ";
        $sql = "Select Taxi_Room_RoomId from Taxi_Join WHERE Taxi_Guest_guestId = '$guestId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $roomId = $row1['Taxi_Room_RoomId'];
        $sql = "Select * from Taxi_Room WHERE RoomId = '$roomId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $hostId = $row1['Taxi_Host_hostId'];
        $sql = "Select * from Taxi_Host where hostId = '$hostId'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $hostuser = $row['User_UserId'];
        $sql = "Select * from User WHERE UserId = '$hostuser'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $account = $row['Account'];
        $Phone = $row['Phone'];

        echo"
        <span style='text-align: left'><font class='c' color='white' size='5'>Time : ".$row1['Time']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Departure : ".$row1['Departure']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Arrival : ".$row1['Arrival']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Number of Guest : ".$row1['GN']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Status : ".$row1['Status']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Account : $account</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Phone : $Phone</font></span><br>
        ";
        if($row1['Status'] == 'Closed'){
            echo "<form method = 'post' action='taxi_chat_save.php'><input type = 'hidden' name = 'roomid' value = '$roomId'><input type='submit' value='chat'></form>";
        }
        echo "</td>";
        $a ++;
    }
}
echo "</tr>";
echo"<tr>";

$sql = "Select hostId from Carpool_Host WHERE User_UserId = '$user'";
$result = mysqli_query($conn,$sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $hostId = $row['hostId'];
        $sql = "Select * from User WHERE UserId = '$user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $account = $row['Account'];
        $Phone = $row['Phone'];
        echo "<td>
        <span style='text - align: left'><font class='c' color='white' size='7'>Carpool Room $b</font> </span><br>
        <span style='text-align: left'><font class='c' color='white' size='6'>Host</font></span><br>
        ";
        $sql = "Select * from Carpool_Room WHERE Carpool_Host_hostId = '$hostId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $roomId = $row1['RoomId'];
        echo"
        <span style='text-align: left'><font class='c' color='white' size='5'>Time : ".$row1['Time']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Departure : ".$row1['Departure']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Arrival : ".$row1['Arrival']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Number of Guest : ".$row1['GN']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Expected Price : ".$row1['Price']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Car Kind: ".$row1['Kind']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Status : ".$row1['Status']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Account : $account</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Phone : $Phone</font></span><br>
        ";
        $b ++;
        if($row1['Status'] == 'open'){
            echo "<form method = 'post'><button name = 'close'>close</button></form>";
            if(isset($_POST['close'])){
                $sql = "Update Carpool_Room Set Status = 'Closed' where Carpool_Host_hostId = '$hostId'";
                mysqli_query($conn, $sql);
            }
        }
        else{
            echo "<form method = 'post' action='car_chat.php'><input type = 'hidden' name = 'roomid' value = '$roomId'><input type='submit' value='chat'></form>";
        }
        echo "</td>";
    }
}
$sql = "Select guestId from Carpool_Guest WHERE User_UserId = '$user'";
$result = mysqli_query($conn,$sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $guestId = $row['guestId'];
        echo "<td>
        <span style='text - align: left'><font class='c' color='white' size='7'>Carpool Room $a</font> </span><br>
        <span style='text-align: left'><font class='c' color='white' size='6'>Guest</font></span><br>
        ";
        $sql = "Select Carpool_Room_RoomId from Carpool_Join WHERE Carpool_Guest_guestId = '$guestId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $roomId = $row1['Carpool_Room_RoomId'];
        $sql = "Select * from Carpool_Room WHERE RoomId = '$roomId'";
        $res = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_array($res);
        $hostId = $row1['Carpool_Host_hostId'];
        $sql = "Select * from Carpool_Host where hostId = '$hostId'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $hostuser = $row['User_UserId'];
        $sql = "Select * from User WHERE UserId = '$hostuser'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $account = $row['Account'];
        $Phone = $row['Phone'];

        echo"
        <span style='text-align: left'><font class='c' color='white' size='5'>Time : ".$row1['Time']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Departure : ".$row1['Departure']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Arrival : ".$row1['Arrival']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Number of Guest : ".$row1['GN']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Expected Price : ".$row1['Price']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Car Kind: ".$row1['Kind']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Status : ".$row1['Status']."</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Account : $account</font></span><br>
        <span style='text-align: left'><font class='c' color='white' size='5'>Host Phone : $Phone</font></span><br>
        ";
        if($row1['Status'] == 'Closed'){
            echo "<form method = 'post' action='car_chat.php'><input type = 'hidden' name = 'roomid' value = '$roomId'><input type='submit' value='chat'></form>";
        }
        echo "</td>";
        $b ++;
    }
}
echo "</tr>";
echo "
</table>
<br>
<a href='main.html'><input type = 'button' VALUE='go back'></a>
</body>
</html>";
?>
