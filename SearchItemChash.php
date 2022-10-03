
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

require_once('controller/ConnectDBl.php');
$pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$name= $_GET['key'];
$sql = "SELECT * FROM item WHERE `name` like '%$name%' or 
    `company` like '%$name%'  ";
$result =$pdo->query($sql);
if($result==null){
    $sql2 = "SELECT * FROM profile";
    $result =$pdo->query($sql2);
}
while ($row = $result->fetch()) {
    ?>
    <div class="col-sm-4">
        <div class="thumbnail">
            <div class="card text-center" style="width:200px" >
                <img class="card-img-top" src="img/item/<?php echo $row['img']; ?>" width="200" height="100">
                <div class="card-body">
                    <p>الاسم :<?php echo $row['name'];?></p>
                    <p> الشركة :<?php echo $row['company'];?></p>
                    <p> السعر :<?php echo $row['price'];?></p>
                    <form method="post" action="controller/order.php">
                        <input value="<?php echo $row['id']; ?>" type="hidden" name="item_id" id="item_id">
                        <input value="<?php echo $_GET['cart_code']; ?>" type="hidden" name="cart_code" id="cart_code">
                        <label>
                            <input class="form-control" type="number" name="amount" placeholder="ادخل الكمية">
                        </label>
                        <button class="btn bg-success" name="addcart" >أضافة </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<? } ?>

</body>
</html>