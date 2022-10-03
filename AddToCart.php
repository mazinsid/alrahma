
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

require_once('controller/order.php');



$cart_code=$_GET['cart_code'];
$item_id=$_GET['item_id'];
$amount=$_GET['amount'];

$ins=new order();
$ins->insrtCart($cart_code,$item_id,$amount);


$result=$ins->GetCart($cart_code);
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

</body>
</html> 