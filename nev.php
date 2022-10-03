
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/fontawesome/less/fontawesome.less" rel="stylesheet">
    <link href="/fontawesome/scss/fontawesome.scss" rel="stylesheet">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <link href="/fontawesome/css/all.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    <style>
        body {font-family: "Lato", sans-serif;}

        .sidebar {
            height: 100%;
            width: 160px;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 16px;
        }

        .sidebar a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .main {
            margin-right: 160px; /* Same as the width of the sidenav */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidebar {padding-top: 15px;}
            .sidebar a {font-size: 18px;}
        }
    </style>
</head>
<body >

<div class="sidebar" >
    <a href="#"><i class="fa fa-fw fa-user-circle"></i> <?php
        session_start();
        echo $_SESSION['user_name'];
        ?></a>
    <a href="home.php"><i class="fas fa-home" style='color:green'></i> الرئسية</a>

    <a href="item.php"><i class="fas fa-boxes"></i> البضاعة</a>
    <a href="categories.php"><i class="fas fa-clipboard-list"></i> الاصناف</a>
    <a href="coming.php"><i class="fas fa-running" style="color:green"></i> الوارد</a>
    <a href="store.php"><i class="fas fa-store"></i> المخزن</a>
    <a href="custamer.php"><i class="fas fa-user-injured"></i> الزبائن</a>
    <a href="supplier.php"><i class="fas fa-shipping-fast"></i> الموردين</a>
    <a href="Outgoing.php"><i class="fas fa-clipboard-list" style='color:red'></i> المنصرفات</a>
    <a href="users.php"><i class="fas fa-users"></i> الموظفين</a>

</div>


</body>
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<script src="js/icon.js"></script>
<script src="fontawesome/js/all.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
