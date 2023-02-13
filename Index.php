<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title id="Title">Trang chủ</title>
</head>

<body onload="LoadDash()">

<!-- <body> -->
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
                <!-- <img class=".imageContent" src="image/adminImage.jpg" alt=""> -->
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Them script -->
    <!--  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script> -->
    <script src="./script/script.js"></script>
</body>

</html>