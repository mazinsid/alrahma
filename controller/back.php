<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');

if(isset($_POST['toback'])){
    $user_id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    $amount=$_POST['amount'];
    $DateTime=$_POST['DateTime'];

    $ins=new back();
    $ins->InsertBack($user_id,$item_id,$amount,$DateTime);
}


class back
{
    public function InsertBack($user_id,$item_id,$amount,$DateTime)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `item_back`(`user_id`, `item_id`, `amount`, `DateTime`) VALUES (?,?,?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $user_id);
            $statment->bindValue(2, $item_id);
            $statment->bindValue(3, $amount);
            $statment->bindValue(4, $DateTime);

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
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../itembake.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }

    public function Getback()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `item_back`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }

}