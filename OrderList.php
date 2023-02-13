<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" async></script>
    <title>Đặt hàng</title>
</head>
<!--  -->
<!-- PHP -->
<!--  -->
<?php
//Ket noi
session_start();
if (!isset($_SESSION['email'])) 
{
    header('Location: ../login.php');
}
require_once('connectDB.php');
$conn = connectDB();

//Tim tong so row
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
$total_records = $result->num_rows;

//Tim limit va page hien tai
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$LIMIT_NUMBER_PAGE = 10;
//ORDER TAGER
$order_target = isset($_GET['order_target']) ? $_GET['order_target'] : 1;

// Tinh maxPage va start
// Tong so trang
$total_page = ceil($total_records / $LIMIT_NUMBER_PAGE);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $LIMIT_NUMBER_PAGE;

// Truy van lay du lieu
// 
$sql_select = "SELECT COUNT(id_order) as Lan,name,user.email,ngay FROM orders,user WHERE orders.email = user.email GROUP BY user.email LIMIT $start, $LIMIT_NUMBER_PAGE";
$result = $conn->query($sql_select);
$proArray = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($proArray, $row);
    }
}

//GET VALUE USER
$indexID = isset($_GET['email']) ? $_GET['email'] : 0;
$idUser = isset($proArray[$indexID]['email']) ? $proArray[$indexID]['email'] : $proArray[0]['email'];

//Chua co ma ORDER
$sql = "SELECT name,sex,id_order, user.email,address FROM `user`,`orders` WHERE '$idUser' = orders.email AND orders.email = user.email";
// die($sql);
$result2 = $conn->query($sql);
$userArray = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        array_push($userArray, $row);
    }
}
//GET PRODUCT ORDERED
// SELECT * FROM orders,cart,products,user WHERE "xuanquytt2410@gmail.com" = cart.email AND orders.email = "xuanquytt2410@gmail.com" AND cart.id_prod=products.id_product AND "xuanquytt2410@gmail.com" = user.email; 
$ordersemail = isset($proArray[$indexID]['email']) ? $proArray[$indexID]['email'] : 0;
$sql = "SELECT price,cart.email,cart.id_prod,cart.soluongdat,products.name FROM products, cart, cart as c2 
WHERE '$ordersemail' = cart.email AND cart.email = c2.email AND cart.id_prod = c2.id_prod AND products.id_product = cart.id_prod";
$result3 = $conn->query($sql);
$cartArray = [];
if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        array_push($cartArray, $row);
    }
}
//disconnect
$conn->close();
?>

<body onload="loadOrderList()" class="OrderList">
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
                <!-- danh sach -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Đặt hàng</h2>
                            <a href="#"></a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Tên</td>
                                    <td>Email</td>
                                    <td>Ngày</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if (isset($proArray[0]['name']))  echo $proArray[0]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['email']))   echo $proArray[0]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['ngay'])) echo $proArray[0]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[1]['name']))  echo $proArray[1]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['email']))   echo $proArray[1]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['ngay'])) echo $proArray[1]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[2]['name']))  echo $proArray[2]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['email']))   echo $proArray[2]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['ngay'])) echo $proArray[2]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[3]['name']))  echo $proArray[3]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['email']))   echo $proArray[3]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['ngay'])) echo $proArray[3]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[4]['name']))  echo $proArray[4]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['email']))   echo $proArray[4]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['ngay'])) echo $proArray[4]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[5]['name']))  echo $proArray[5]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['email']))   echo $proArray[5]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['ngay'])) echo $proArray[5]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[6]['name']))  echo $proArray[6]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['email']))   echo $proArray[6]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['ngay'])) echo $proArray[6]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[7]['name']))  echo $proArray[7]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['email']))   echo $proArray[7]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['ngay'])) echo $proArray[7]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[8]['name']))  echo $proArray[8]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['email']))   echo $proArray[8]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['ngay'])) echo $proArray[8]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[9]['name']))  echo $proArray[9]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['email']))   echo $proArray[9]['email'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['ngay'])) echo $proArray[9]['ngay'];
                                        else echo ""; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- PAGING -->
                        <!-- PREVIOUS -> LOOP PAGE NUMBER -> NEXT -->
                        <div class="paging">
                            <?php
                            if ($current_page > 1 && $total_page > 1) {
                                echo '<a href="OrderList.php?page=' . ($current_page - 1) . '">Prev</a>  ';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<span style="font-weight: bold; color: black">' . $i . '</span>  ';
                                } else {
                                    echo '<a href="OrderList.php?page=' . $i . '">' . $i . '</a>  ';
                                }
                            }
                            if ($current_page < $total_page && $total_page > 1) {
                                echo '<a href="OrderList.php?page=' . ($current_page + 1) . '">Next</a>  ';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="infoOrderCard">
                        <div class="userCardHeader">
                            <h2>Chi tiết</h2>
                            <a href="#"></a>
                        </div>
                        <div class="infoOrder">
                            <div class="cardImg">
                                <img src="Images/img4.jpg" alt="">
                            </div>
                            <table>
                                <tr>
                                    <th>Tên</th>
                                    <th><?php if (count($userArray, 1) > 0) echo $userArray[0]['name'];
                                        else echo "NO INFO" ?></th>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <th><?php if (count($userArray, 1) > 0) echo $userArray[0]['sex'];
                                        else echo "NO INFO" ?></th>
                                </tr>
                                <tr>
                                    <th>Số lần: </th>
                                    <th><?php if (count($userArray, 1) > 0) echo $proArray[0]['Lan'];
                                        else echo "NO INFO" ?></th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th><?php if (count($userArray, 1) > 0) echo $userArray[0]['email'];
                                        else echo "NO INFO" ?></th>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <th><?php if (count($userArray, 1) > 0) echo $userArray[0]['address'];
                                        else echo "NO INFO" ?></th>
                                </tr>
                            </table>

                        </div>
                        <div class="headerlistProOrder">
                            <h2>Danh sách</h2>
                        </div>
                        <div class="listProOrder">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tên</td>
                                        <td>Số Lượng</td>
                                        <td>Giá</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($cartArray as $cart) {
                                        echo "<tr>";
                                        echo "<td>" . $cart['name'] . "</td>";
                                        echo "<td>" . $cart['soluongdat'] . "</td>";
                                        echo "<td>" . $cart['price'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <!-- Them script -->
    <!--  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" async></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" async></script>
    <script src="./script/script.js" async></script>
    <script type="text/javascript">
        let listOrder = document.querySelectorAll('.recentOrders table tbody tr');
        listOrder.forEach((item) => {
            item.onclick = function() {
                let STT = $(listOrder).index(item);
                var kytu = window.location.href.substr(window.location.href.length - 1);
                var searchID = window.location.href.search("email=");
                if (kytu == 'p') {
                    window.location.href = window.location.href + "?email=" + STT;
                } else if (searchID == -1) {
                    window.location.href = window.location.href + "&email=" + STT;
                } else {
                    var pos = window.location.href.search("email=");
                    // alert(pos);
                    if (pos != -1) {
                        let strOld = window.location.href.substr(pos, window.location.href.length - pos);
                        window.location.href = window.location.href.replace(strOld, "email=" + STT);
                    } else window.location.href = window.location.href + "&email=" + STT;
                }
            }
        });
    </script>
</body>

</html>