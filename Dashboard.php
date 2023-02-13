<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Thống kê</title>
</head>

<!-- PHP -->
<?php
if (!isset($_SESSION['email'])) 
{
    header('Location: ../login.php');
}

//Ket noi
require_once('connectDB.php');
$conn = connectDB();

//
$sql = "SELECT SUM(soluong) as SL, loai FROM products GROUP BY loai";
$result = $conn->query($sql);
$type = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($type, $row);
    }
}
$RC = $type[0]['SL'];
$SS = $type[1]['SL'];
$TC = $type[2]['SL'];
$TH = $type[3]['SL'];

$sql = "SELECT MONTH(ngay) as thang, SUM(soluongdat * products.price) AS tong FROM orders,cart,products 
        WHERE orders.email = cart.email AND cart.id_prod = products.id_product GROUP BY MONTH(ngay);";
$result = $conn->query($sql);

$month = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($month, $row);
    }
}
$t1 = 0;
$t2 = 0;
$t3 = 0;
$t4 = 0;
$t5 = 0;
$t6 = 0;
$t7 = 0;
$t8 = 0;
$t9 = 0;
$t10 = 0;
$t11 = 0;
$t12 = 0;
foreach ($month as $item) {
    if ((string)($item['thang']) == "1")
        $t1 = $item['tong'];
    if ((string)($item['thang']) == "2")
        $t2 = $item['tong'];
    if ((string)($item['thang']) == "3")
        $t3 = $item['tong'];
    if ((string)($item['thang']) == "4")
        $t4 = $item['tong'];
    if ((string)($item['thang']) == "5")
        $t5 = $item['tong'];
    if ((string)($item['thang']) == "6")
        $t6 = $item['tong'];
    if ((string)($item['thang']) == "7")
        $t7 = $item['tong'];
    if ((string)($item['thang']) == "8")
        $t8 = $item['tong'];
    if ((string)($item['thang']) == "9")
        $t9 = $item['tong'];
    if ((string)($item['thang']) == "10")
        $t10 = $item['tong'];
    if ((string)($item['thang']) == "11")
        $t11 = $item['tong'];
    if ((string)($item['thang']) == "12")
        $t12 = $item['tong'];
}

$sql = "SELECT COUNT(ngay) AS orderInDay, SUM(cart.soluongdat * products.price) as valDay FROM orders,cart,products 
        WHERE cart.email = orders.email AND cart.id_prod = products.id_product AND ngay = DATE(CURRENT_DATE)";
$result = $conn->query($sql);

$orderDay = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($orderDay, $row);
    }
}
?>

<body onload="loadDash()">
    <div class="container">
        <?php include 'Menu.php' ?>
        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <!-- Tìm kiếm -->
                <!-- <div class="search">
                    <label>
                        <input type="text" name="" id="" placeholder="Tìm kiếm">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div> -->
                <!-- Ảnh Khách hàng -->
                <!-- <div class="user">
                    <img src="./Images/user.jpg" alt="">
                </div> -->
            </div>
            <div class="content">
                <!-- thẻ -->
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">3,025</div>
                            <div class="cardName">Lượt xem trong ngày</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $orderDay[0]['orderInDay']  ?></div>
                            <div class="cardName">Đơn đặt hàng</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers">108</div>
                            <div class="cardName">Lượt bình luận</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $orderDay[0]['valDay']  ?></div>
                            <div class="cardName">Thu về</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- Ve Bieu Do -->
                <div class="chartTilte">
                    <p>Thống kê</p>
                    <hr>
                </div>
                <div class="grapBox">
                    <div class="box">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="box">
                        <canvas id="revenue"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
                    <script>
                        var ctx1 = document.getElementById('myChart').getContext('2d');
                        var ctx2 = document.getElementById('revenue').getContext('2d');
                        //
                        ////BOX1
                        //
                        var myChart = new Chart(ctx1, {
                            type: 'doughnut',
                            data: {
                                labels: ['Trái cây', 'Thịt', 'Sữa', 'Rau củ'],
                                datasets: [{
                                    label: 'Đặt hàng',
                                    data: [<?php echo $TC ?>, <?php echo $TH ?>, <?php echo $SS ?>, <?php echo $RC ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                    ],
                                }]
                            },
                            options: {
                                reponsive: true,
                                maintainAspectRatio: false
                            }
                        });
                        //
                        //////BOX2
                        //
                        var revenue = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                                datasets: [{
                                    label: 'Doanh thu theo tháng (triệu)',
                                    data: [<?php echo $t1 ?>,<?php echo $t2 ?>,<?php echo $t3 ?>,<?php echo $t4 ?>,<?php echo $t5 ?>,
                                    <?php echo $t6 ?>,<?php echo $t7 ?>,<?php echo $t8 ?>,<?php echo $t9 ?>,<?php echo $t10 ?>,<?php echo $t11 ?>,
                                    <?php echo $t12 ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                }]
                            },
                            options: {
                                reponsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <!-- Them script -->
    <!--  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="./script/chart.js" async></script> -->
    <script src="./script/script.js" ></script>
</body>

</html>