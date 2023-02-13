<?php
require_once('ConnectDB.php');
$conn = connectDB();

if (
    isset($_POST['id_product']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['soluong']) && isset($_POST['loai']) &&
    isset($_POST['nhacungcap']) && isset($_POST['ngaysanxuat']) && isset($_POST['hansudung']) && isset($_POST['description'])
) {

    $id = $_POST['id_product'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $soluong = $_POST['soluong'];
    $loai = $_POST['loai'];
    $nhacungcap = $_POST['nhacungcap'];
    $ngaysanxuat = $_POST['ngaysanxuat'];
    $hansudung = $_POST['hansudung'];
    $description = $_POST['description'];

    if (isset($_FILES['img'])) {
        move_uploaded_file($_FILES['img']['tmp_name'], 'image/' . $_FILES['img']['name']);
        $nameImg = 'image/' . $_FILES['img']['name'];

        $sql = "UPDATE products 
                SET name = '$name',
                    price = '$price',
                    soluong = '$soluong',
                    loai = '$loai',
                    nhacungcap = '$nhacungcap',
                    ngaysanxuat = '$ngaysanxuat',
                    hansudung = '$hansudung',
                    description = '$description',
                    img = '$nameImg'
                WHERE id_product = '$id'";
    } else {
        $sql = "UPDATE products 
                SET name = '$name',
                    price = '$price',
                    soluong = '$soluong',
                    loai = '$loai',
                    nhacungcap = '$nhacungcap',
                    ngaysanxuat = '$ngaysanxuat',
                    hansudung = '$hansudung',
                    description = '$description'
                WHERE id_product = '$id'";
    }
    $conn->query($sql);
    echo "Cập nhập thông tin thành công";
};


$conn->close();
