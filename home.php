<!DOCTYPE html>
<html lang="en">
<head>
    <title>SEL</title>
</head>
<body>
<header>
<?php
require('nev.php');
?>
</header>
<div class="main">
    <div class="card">
        <div class="card-header">fjfdlfl</div>
    </div>
<?php require_once('./controller/order.php');
$cat = new order();
$result=$cat->codeCart();
$cart_code= 0;
while ($row = $result->fetch()){
$cart_code =$row['cart_code'];
}
 $cart_code = $cart_code+1;
?>
    <div class="card-body">
        <a class="btn btn-dark btn-lg" href="cashar.php?cart_code=<? echo $cart_code ; ?>"><i class="fas fa-cart-plus" style='color:green'></i> عملية بيع</a>
        <a class="btn btn-dark btn-lg" href="itembake.php"><i class="fas fa-cart-arrow-down" style='color:yellow'></i> الراجع</a>
        <a class="btn btn-dark btn-lg" href="trash.php"><i class="far fa-trash-alt" style='color:red'></i> التالف</a>
    </div>
</div>
 </body>
</html>