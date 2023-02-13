<?php
// SS TH TC RC

use function PHPSTORM_META\type;

require_once('ConnectDB.php');
$conn = connectDB();

if (isset($_POST['getData'])) {
    $sql = "SELECT SUM(soluong) as SL, loai FROM products GROUP BY loai";
    $result = $conn->query($sql);
    $type = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($type, $row);
        }
    }
    // echo $type[0]['loai'];
    echo json_encode($type);
}
