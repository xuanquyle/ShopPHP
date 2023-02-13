<?php
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "greenhub";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    return $conn;
}
function getAllRow($conn,$tableSeclect)
{
    $sql="SELECT * FROM '$tableSeclect'";
    $result = $conn->query($sql);
    echo $result->num_rows;
    return $result;
}
?>
