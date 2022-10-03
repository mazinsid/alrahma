<?php
require_once('./controller/item.php');

$cart_code=$_GET['cart_code'];
$item_id=$_GET['item_id'];
$amount=$_GET['amount'];


$ins=new order();
$ins->insrtCart($cart_code,$item_id,$amount);
