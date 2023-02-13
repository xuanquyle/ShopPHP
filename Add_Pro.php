<?php
    require_once('ConnectDB.php');
    $conn = connectDB();
    
    if(isset($_POST['id_product']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['soluong']) && isset($_POST['loai']) &&
    isset($_POST['nhacungcap']) && isset($_POST['ngaysanxuat']) && isset($_POST['hansudung']) && isset($_POST['description'])
    && isset($_FILES['img']))
    {    
        $id = $_POST['id_product'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $soluong = $_POST['soluong'];
        $loai = $_POST['loai'];
        $nhacungcap = $_POST['nhacungcap'];
        $ngaysanxuat = $_POST['ngaysanxuat'];
        $hansudung = $_POST['hansudung'];
        $description = $_POST['description'];

        move_uploaded_file($_FILES['img']['tmp_name'],'image/' . $_FILES['img']['name']);
        $nameImg = 'image/' . $_FILES['img']['name'];

        $sql = "INSERT INTO products (id_product,name,price,description,soluong,nhacungcap,loai,ngaysanxuat,hansudung,img)
                VALUES('$id','$name','$price','$description','$soluong','$nhacungcap','$loai','$ngaysanxuat','$hansudung','$nameImg')";     

        $conn->query($sql);
        echo "Thêm mới sản phẩm thành công";
    };   
    

    $conn->close();
?>