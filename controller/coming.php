<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');

if(isset($_POST['insert'])){
    $supplier_id = $_POST['supplier_id'];
    $item_id = $_POST['item_id'];
    $amount=$_POST['amount'];
    $pirce=$_POST['pirce'];
    $Date_Time=$_POST['Date_Time'];
    $tatal = $pirce*$amount;
    $ins=new coming();
    $ins->insert($supplier_id,$item_id,$amount,$pirce,$tatal,$Date_Time);
}
class coming
{
    public function Getcoming()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `coming`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function insert($supplier_id,$item_id,$amount,$pirce,$tatal,$Date_Time)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `coming`( `supplier_id`, `item_id`, `amount`, `pirce`, `total`, `dateTime`) 
            VALUES (?,?,?,?,?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $supplier_id);
            $statment->bindValue(2, $item_id);
            $statment->bindValue(3, $amount);
            $statment->bindValue(4, $pirce);
            $statment->bindValue(5, $tatal);
            $statment->bindValue(6, $Date_Time);

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