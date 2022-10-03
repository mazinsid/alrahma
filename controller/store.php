<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');





if(isset($_POST['toStore'])){
    $item_id = $_POST['type_id'];
    $amount=$_POST['amount'];

    $ins=new store();
    $ins->insertstore($item_id,$amount);
}
if(isset($_POST['toMarket'])){
    $item_id = $_POST['type_id'];
    $amount=$_POST['amount'];

    $ins=new store();
    $ins->toMarket($item_id,$amount);
}


class store
{

    public function Getstore()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `store`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function insertstore($item_id,$amount)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `store`( `item_id`, `amount` ) 
            VALUES (?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $item_id);
            $statment->bindValue(2, $amount);

            $statment->execute();
            try {

                      $id = $item_id;
                    $sql = "UPDATE `item` SET `amount`= (`amount`-'$amount') WHERE `id`='$id'";
                    $statment = $pdo->prepare($sql);
                    $statment->execute();

            }catch (PDOException $e){
                die($e->getMessage());
            }
            echo "<script> alert('تم الدخال بنجاح'); </script>";
           echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../store.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function toMarket($item_id,$amount)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE  `store` SET `amount` = ( `amount` - '$amount' ) where `item_id`= '$item_id'";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $item_id);
            $statment->bindValue(2, $amount);

            $statment->execute();
            try {

                $id = $item_id;
                $sql = "UPDATE `item` SET `amount`= (`amount`+'$amount') WHERE `id`='$id'";
                $statment = $pdo->prepare($sql);
                $statment->execute();

            }catch (PDOException $e){
                die($e->getMessage());
            }
            echo "<script> alert('تم الدخال بنجاح'); </script>";
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../store.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }

}