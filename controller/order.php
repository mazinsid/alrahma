<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');

if (isset($_POST['addcart'])){

    $cart_code=$_POST['cart_code'];
    $item_id=$_POST['item_id'];
    $amount=$_POST['amount'];

    $ins=new order();
    $ins->insrtCart($cart_code,$item_id,$amount);

}if (isset($_POST['addOrder'])){

    $user = $_POST['user'];
    $customer_id = $_POST['customer_id'];
    $cart_code = $_POST['cart_code'];
    $discount = $_POST['discount'];
    $total = $_POST['total'];
    $type_pay = $_POST['type_pay'];
    $Date_Time = $_POST['Date_Time'];

    $ins=new order();
    $ins->addOrder($user,$customer_id,$cart_code,$discount,$total,$type_pay,$Date_Time);

}
if (isset($_POST['deleteCart'])){
    $id = $_POST['cart_id'];
    $ins=new order();
    $ins->deleteCart($id);
}

class order
{
    public function deleteCart($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `cart` WHERE `id` = ?  " ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $id);

            $statment->execute();
//            ?>
<!--            <META HTTP-EQUIV='Refresh' Content=0;URL='../cashar.php?cart_code=--><?// echo $cart_code ; ?><!--'>-->
<!--            --><?php
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function codeCart(){
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `cart` ORDER BY id DESC LIMIT 1";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function GetCart($cart_code){
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `cart` where `cart_code` =  '$cart_code' ";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function insrtCart($cart_code,$item_id,$amount)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `cart`(`cart_code`,`item_id`,`amount`) VALUES (?,?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $cart_code);
            $statment->bindValue(2, $item_id);
            $statment->bindValue(3, $amount);

            $statment->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function addOrder($user,$customer_id,$cart_code,$discount,$total,$type_pay,$Date_Time)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `order`( `user`, `customer_id`, `cart_code`, `discount`, `total`, `type_pay`, `Date_Time`) VALUES  (?,?,?,?,?,?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $user);
            $statment->bindValue(2, $customer_id);
            $statment->bindValue(3, $cart_code);
            $statment->bindValue(4, $discount);
            $statment->bindValue(5, $total);
            $statment->bindValue(6, $type_pay);
            $statment->bindValue(7, $Date_Time);

            $statment->execute();
            try {
                $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $result=order::GetCart($cart_code);
                while ($row = $result->fetch()){
                   $amount = $row ['amount'];
                   $id = $row ['item_id'];
                    $sql = "UPDATE `item` SET `amount`= (`amount`-'$amount') WHERE `id`='$id'";
                    $statment = $pdo->prepare($sql);
                    $statment->execute();
                }
            }catch (PDOException $e){
                die($e->getMessage());
            }

            echo "<script> alert('تم الدخال بنجاح'); </script>";
            ?> <META HTTP-EQUIV='Refresh' Content=0;URL='../home.php'>
            <?php
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
}