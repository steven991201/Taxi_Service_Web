<?php


$servername = "127.0.0.1:3306";
$username = "root";
$password = "steven1971";
$dbname = "TC";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "select * from Taxi_Room where Status='Open'";

$res = mysqli_query($conn,$sql);
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
        p{
            background-color: rgba(0,0,0,0.6);
        }
        .c { font-family: sans-serif; }
    </style>
</head>
<body>
<center>";
echo "<p style='text-align: center'><font class='c' color='white' size='5'>List of current Room</font></p>";
echo "<table border = '5' bgcolor='white' cellpadding='5'><thead>
<th><b><span style='text-align: center'><font class='c' color='black' size='4'>RoomId</font></span></b></th>
<th><b><span style='text-align: center'><font class='c' color='black' size='4'>Departure Point</font></span></b></th>
<th><b><span style='text-align: center'><font class='c' color='black' size='4'>Arrival Point</font></span></b></th>
<th><b><span style='text-align: center'><font class='c' color='black' size='4'>Departure Time</font></span></b></th>
<th><b><span style='text-align: center'><font class='c' color='black' size='4'>Current Member</font></span></b></th>
</thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($res)){
    $dt = $row['Time'];
    $month = substr($dt,0,2);
    $day = substr($dt,2,2);
    $hour = substr($dt,3,2);
    $minute = substr($dt,4,2);

    echo "<tr><td>" .$row['RoomId']. "</td><td>" .$row['Departure']. "</td><td>" .$row['Arrival']. "</td><td>" .$month. "/" .$day. " - " .$hour. ":" .$minute. "</td><td>" .$row['GN']. "</td></tr>";
}
echo "</tbody></table>";

echo "<a href='join_select.html'><input type='button' value='Select Room'></a>";
echo "</center>";



