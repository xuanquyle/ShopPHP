<?php
    require_once('ConnectDB.php');
    $conn = connectDB();
    
    if(isset($_POST['id_product']))
    {
        
        $id = $_POST['id_product'];

        $sql = "DELETE FROM products WHERE id_product = '$id'";

        $conn->query($sql);
        echo "Xóa sản phẩm thành công";
    };   
    

    $conn->close();
?>