
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
<body>
</header>
<?php
session_start();
?>
<div class="container">

    <div class="card-header">
        <div class="form-group">
            <div class="col-sm-10">
                <input class="form-control" onkeyup="searchinfo()" type="text" placeholder="بحث" id="search" name="search">
            </div>
        </div>
    <div class="row">
            <div class="col-sm-8">
                <div class="row" id="cart-body">
                <?php require_once('./controller/item.php');
                $cat = new item();
                $result=$cat->Getitem();
                while ($row = $result->fetch()){
                    ?>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <div class="card text-center" style="width:200px" >
                                <img class="card-img-top" src="img/item/<?php echo $row['img']; ?>" width="200" height="100">
                                <div class="card-body">
                                    <p>الاسم :<?php echo $row['name'];?></p>
                                    <p> الشركة :<?php echo $row['company'];?></p>
                                    <p> السعر :<?php echo $row['price'];?></p>
                                         <input value="<?php echo $row['id']; ?>" type="hidden" name="item_id" id="item_id">
                                        <input value="<?php echo $_GET['cart_code']; ?>" type="hidden" name="cart_code" id="cart_code">
                                    <label>
                                        <input class="form-control" type="number" name="amount" id="amount" placeholder="ادخل الكمية">
                                    </label>
                                    <button onclick="itemInfo()" class="btn bg-success" name="addcart" >أضافة </button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>

            </div>
            </div>

        <div class="col-sm-4" >
            <table  class="table table-striped">
                <thead>
                <tr>
                    <td>اسم امنتج</td>
                    <td>الكمية</td>
                    <td>السعر</td>
                    <td>الاجمالي</td>
                    <td>حزف</td>
                </tr>
                </thead>
                <tbody id="cart-info">
            <?php require_once('./controller/order.php');
            $cat = new order();
            $cart_code =  $_GET['cart_code'];
            $result=$cat->GetCart($cart_code);
            $cou = 0 ;
            $total =0 ;
            while ($row = $result->fetch()){
                ?>
            <tr>
                <?
                require_once('./controller/item.php');
             $item = new item();
             $id=$row['item_id'];
            $resultt=$item->GetItemID($id);
            while ($rowt = $resultt->fetch()){?>
                <td><? echo $rowt['name']; ?></td>
                <td><?echo $row['amount']; ?></td>
                <td><?echo $rowt['price']; ?></td>
                <td><?echo $t= $row['amount']*$rowt['price'] ;?></td>
                <td> <form action="controller/order.php" method="post">
                        <input type="hidden" name="cart_id" value="<? echo $row['id']?>">
                        <button type="submit" class="btn badge-danger" name="deleteCart">حزف</button>
                    </form></td>
                <?
                $total = $total + $t; ?>
            </tr>
            <? }
            } ?>

            </tr>

                </tbody>
            </table>
            <hr>
            <div class="form">
                    <form action="controller/order.php" method="post">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="hidden" value="<?php echo $_SESSION['user_name'];?>" name="user">
                                <input type="hidden" value="<?php echo $cart_code ;?>" name="cart_code">
                                <input type="hidden" value="<?php echo date('y/m/d',time());?>" name="Date_Time">
                                الحساب الاجمالي    <input type="text" value="<? echo $total ;?>" class="form-control" name="total" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                الزبون
                             <select name="customer_id" class="form-control">
                                 <option value=""> ...</option>
                                 <option value="0">زبون </option>
                                 <?php require_once('./controller/customer.php');
                                 $cat = new customer();
                                 $resultc=$cat->GetCustomer();
                                 while ($rowc = $resultc->fetch()){
                                 ?>
                                 <option value="<?php echo $rowc['id'];?>"><?php echo $rowc['name'] ; ?></option>
                                 <? } ?>
                             </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                الخسم    <input type="text" value="" class="form-control" name="discount" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                طريفة الدفع
                            <select name="type_pay" class="form-control">
                                <option value="كاش">كاش</option>
                                <option value="بنك">بنك</option>
                            </select>
                            </div>
                        </div>

                        <button class="form-control btn btn-success" type="submit" name="addOrder" >أتمام عملية الشراء</button>

                    </form>
            </div>
        </div>
        </div>
    </div>
</body>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="js/main.js"></script>
<script>
    function searchinfo() {
        var key = document.getElementById('search').value.toString();
        search(key);
    }</script>
<script>
    function  search(key) {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cart-body").innerHTML = this.responseText;
            }
        };


        xmlhttp.open("GET","SearchItemChash.php?key="+key,true);
        xmlhttp.send();

    }
</script>

<script>
    function itemInfo() {

        var item_id = document.getElementById("item_id").value.toString();
        var cart_code = document.getElementById("cart_code").value.toString();
        var amount = document.getElementById("amount").value.toString();
        insertChart(item_id,cart_code,amount);
    }

    function  insertChart(item_id,cart_code,amount) {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cart-info").innerHTML = this.responseText;
            }
        };


        xmlhttp.open("GET","AddToCart.php?item_id="+item_id+"&cart_code="+cart_code+"&amount="+amount,true);
        xmlhttp.send();




    }
</script>
</html>
<script src="vendor/jquery/jquery-3.2.1.min.js" type="text/javascript">></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript">></script>
<script src="vendor/bootstrap/js/bootstrap.js" type="text/javascript">></script>
<script src="vendor/bootstrap/js/popper.min.js" type="text/javascript">></script>

