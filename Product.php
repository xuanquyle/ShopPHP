<?php
session_start();
if (!isset($_SESSION['email'])) 
{
    header('Location: ../login.php');
}
//Ket noi
require_once('connectDB.php');
$conn = connectDB();

//Tim tong so row
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$total_records = $result->num_rows;

//Tim limit va page hien tai
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$LIMIT_NUMBER_PAGE = 10;
//PRODUCT TAGER
$product_target = isset($_GET['prod_target']) ? $_GET['prod_target'] : 1;

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
$sql_select = "SELECT * FROM products LIMIT $start, $LIMIT_NUMBER_PAGE";
$result = $conn->query($sql_select);
$proArray = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($proArray, $row);
    }
}
//GET VALUE PRODUCT
$indexID = isset($_GET['id_pro']) ? $_GET['id_pro'] : 0;
$idUser = isset($proArray[$indexID]['id_product']) ? $proArray[$indexID]['id_product'] : $proArray[0]['id_product'];
//Chua co ma ORDER
$sql = "SELECT * FROM products WHERE id_product = '$idUser'";
// die($sql);
$result2 = $conn->query($sql);
$product = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        array_push($product, $row);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" async></script>
    <title>Sản phẩm</title>
</head>


<body onload="loadProduct()">
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
                <div class="proContent">
                    <div class="proList">
                        <div class="proHeader">
                            <h2>Sản phẩm</h2>
                            <!-- <button class="addPro">Thêm sản phẩm</button> -->
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Mã</td>
                                    <td>Tên</td>
                                    <td>Giá</td>
                                    <td>Số lượng</td>
                                    <td>Hạn</td>
                                    <td>Nhà cung cấp</td>
                                    <td>loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if (isset($proArray[0]['id_product']))  echo $proArray[0]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['name']))  echo $proArray[0]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['price']))  echo $proArray[0]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['soluong']))  echo $proArray[0]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['hansudung']))  echo $proArray[0]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['nhacungcap']))  echo $proArray[0]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[0]['loai']))  echo $proArray[0]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[1]['id_product']))  echo $proArray[1]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['name']))  echo $proArray[1]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['price']))  echo $proArray[1]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['soluong']))  echo $proArray[1]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['hansudung']))  echo $proArray[1]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['nhacungcap']))  echo $proArray[1]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[1]['loai']))  echo $proArray[1]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[2]['id_product']))  echo $proArray[2]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['name']))  echo $proArray[2]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['price']))  echo $proArray[2]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['soluong']))  echo $proArray[2]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['hansudung']))  echo $proArray[2]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['nhacungcap']))  echo $proArray[2]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[2]['loai']))  echo $proArray[2]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[3]['id_product']))  echo $proArray[3]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['name']))  echo $proArray[3]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['price']))  echo $proArray[3]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['soluong']))  echo $proArray[3]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['hansudung']))  echo $proArray[3]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['nhacungcap']))  echo $proArray[3]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[3]['loai']))  echo $proArray[3]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[4]['id_product']))  echo $proArray[4]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['name']))  echo $proArray[4]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['price']))  echo $proArray[4]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['soluong']))  echo $proArray[4]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['hansudung']))  echo $proArray[4]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['nhacungcap']))  echo $proArray[4]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[4]['loai']))  echo $proArray[4]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[5]['id_product']))  echo $proArray[5]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['name']))  echo $proArray[5]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['price']))  echo $proArray[5]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['soluong']))  echo $proArray[5]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['hansudung']))  echo $proArray[5]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['nhacungcap']))  echo $proArray[5]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[5]['loai']))  echo $proArray[5]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[6]['id_product']))  echo $proArray[6]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['name']))  echo $proArray[6]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['price']))  echo $proArray[6]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['soluong']))  echo $proArray[6]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['hansudung']))  echo $proArray[6]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['nhacungcap']))  echo $proArray[6]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[6]['loai']))  echo $proArray[6]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[7]['id_product']))  echo $proArray[7]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['name']))  echo $proArray[7]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['price']))  echo $proArray[7]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['soluong']))  echo $proArray[7]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['hansudung']))  echo $proArray[7]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['nhacungcap']))  echo $proArray[7]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[7]['loai']))  echo $proArray[7]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[8]['id_product']))  echo $proArray[8]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['name']))  echo $proArray[8]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['price']))  echo $proArray[8]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['soluong']))  echo $proArray[8]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['hansudung']))  echo $proArray[8]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['nhacungcap']))  echo $proArray[8]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[8]['loai']))  echo $proArray[8]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                                <tr>
                                    <td><?php if (isset($proArray[9]['id_product']))  echo $proArray[9]['id_product'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['name']))  echo $proArray[9]['name'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['price']))  echo $proArray[9]['price'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['soluong']))  echo $proArray[9]['soluong'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['hansudung']))  echo $proArray[9]['hansudung'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['nhacungcap']))  echo $proArray[9]['nhacungcap'];
                                        else echo ""; ?></td>
                                    <td><?php if (isset($proArray[9]['loai']))  echo $proArray[9]['loai'];
                                        else echo ""; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- PAGING -->
                        <!-- PREVIOUS -> LOOP PAGE NUMBER -> NEXT -->
                        <div class="paging">
                            <?php
                            if ($current_page > 1 && $total_page > 1) {
                                echo '<a href="Product.php?page=' . ($current_page - 1) . '">Prev</a>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<span style="font-weight: bold; color: black">' ." ". $i . " ".'</span>';
                                } else {
                                    echo '<a href="Product.php?page=' . $i . '">'." " . $i . " ".'</a>';
                                }
                            }
                            if ($current_page < $total_page && $total_page > 1) {
                                echo '<a href="Product.php?page=' . ($current_page + 1) . '">Next</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="proInfo">
                        <div class="proMoreInfoHeader">
                            <h2>Chi tiết</h2>
                            <div class="btnPro">
                                <button class="addPro">Thêm mới</button>
                                <button class="editPro">Chỉnh sửa</button>
                                <button class="savePro">Lưu</button>
                                <button class="deletePro">Xóa</button>
                            </div>
                        </div>
                        <div class="proMoreInfo">
                            <div class="proImg">
                                <img src="<?php if (count($product, 1) > 0) echo $product[0]['img'];
                                            else echo "image/white.png" ?>" alt="" id="imgPro">
                            </div>
                            <div class="proCard">
                                <form id="frmPro" method="POST" action=""></form>
                                <table>
                                    <tr>
                                        <th>Mã sản phẩm:</th>
                                        <th><input type="text" id="MaSP" name="id" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['id_product'];
                                                                                                        else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Tên sản phẩm:</th>
                                        <th><input type="text" id="TenSP" name="name" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['name'];
                                                                                                            else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Giá:</th>
                                        <th><input type="text" id="Gia" name="price" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['price'];
                                                                                                            else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Số lượng:</th>
                                        <th><input type="text" id="SL" name="soluong" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['soluong'];
                                                                                                            else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Nhà cung cấp:</th>
                                        <th><input type="text" id="NCC" name="nhacungcap" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['nhacungcap'];
                                                                                                                else echo "" ?>" readonly></th>
                                    </tr>
                                </table>
                            </div>
                            <div class="proCard">
                                <table>
                                    <tr>
                                        <th>Ngày sản xuất:</th>
                                        <th><input type="text" id="NSX" name="ngaysanxuat" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['ngaysanxuat'];
                                                                                                                else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Hạn sử dụng:</th>
                                        <th><input type="text" id="HSD" name="hansudung" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['hansudung'];
                                                                                                                else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Loại:</th>
                                        <th><input type="text" id="Loai" name="loai" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['loai'];
                                                                                                            else echo "" ?>" readonly></th>
                                    </tr>
                                    <tr>
                                        <th>Mô tả:</th>
                                        <th><input type="text" id="Mota" name="description" form="frmPro" value="<?php if (count($product, 1) > 0) echo $product[0]['description'];
                                                                                                                    else echo "" ?>" readonly></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <input type="file" name="img" id="img" form="frmPro" value="Chọn ảnh" style="display: none;">
                    </div>
                    <!-- <div class="frmAddPro">
                        aaaaaaaaaaaaa
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Them script -->
    <!--  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" async></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" async></script>
    <script src="./script/productInfo.js" async></script>
    <script src="./script/script.js" async></script>
    <script>
        var status = 0;
        let listPro = document.querySelectorAll('.proList table tbody tr');
        listPro.forEach((item) => {
            item.onclick = function() {
                let STT = $(listPro).index(item);
                var kytu = window.location.href.substr(window.location.href.length - 1);
                var searchID = window.location.href.search("id_pro=");
                if (kytu == 'p') {
                    window.location.href = window.location.href + "?id_pro=" + STT;
                } else if (searchID == -1) {
                    window.location.href = window.location.href + "&id_pro=" + STT;
                } else {
                    var pos = window.location.href.search("id_pro=");
                    // alert(pos);
                    if (pos != -1) {
                        let strOld = window.location.href.substr(pos, window.location.href.length - pos);
                        window.location.href = window.location.href.replace(strOld, "id_pro=" + STT);
                    } else window.location.href = window.location.href + "&id_pro=" + STT;
                }
            }
        });

        //ADD
        $('.addPro').click(function() {
            status = 0;
            $('.proCard table tr th input').removeAttr("readonly");
            $('#imgPro').attr('src', 'image/white.png');
            $('.proCard table tr th input').attr('value', "");
            $('#img').show();
        })

        //EDIT
        $('.editPro').click(function() {
            status = 1;
            $('.proCard table tr th input').removeAttr("readonly");
            $('#MaSP').attr('readonly', true);
            $('#img').show();
        })

        //SAVE
        $('.savePro').click(function() {

            var id = $('#MaSP').val();
            var TenSP = $('#TenSP').val();
            var Gia = $('#Gia').val();
            var SL = $('#SL').val();
            var NCC = $('#NCC').val();
            var NSX = $('#NSX').val();
            var HSD = $('#HSD').val();
            var Loai = $('#Loai').val();
            var Mota = $('#Mota').val();
            var imgPro = $('#img')[0].files;
            var formData = new FormData();

            formData.append('id_product', id);
            formData.append('name', TenSP);
            formData.append('price', Gia);
            formData.append('soluong', SL);
            formData.append('nhacungcap', NCC);
            formData.append('ngaysanxuat', NSX);
            formData.append('hansudung', HSD);
            formData.append('loai', Loai);
            formData.append('description', Mota);
            formData.append('img', imgPro[0]);

            if (status == 0) {
                $.ajax({
                    url: "Add_Pro.php",
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        alert(data)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });

            }
            //UPDATE
            if (status == 1) {
                $.ajax({
                    url: "Update_Pro.php",
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        alert(data)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        })
        //Xoa
        $('.deletePro').click(function() {
            var id = $('#MaSP').val();
            // alert("a");
            var dataString = 'id_product=' + id;
            $.ajax({
                type: "POST",
                url: "Delete_Pro.php",
                data: dataString,
                cache: false,
                success: function(result) {
                    alert(result);
                }
            });
            Window.location.href = Window.location.href;
        });
    </script>
</body>

</html>