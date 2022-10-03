<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');





if(isset($_POST['insert'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $ins = new supplier();
    $ins->insertsupplier($name, $phone);
}

class supplier
{
    public function insertsupplier($name, $phone)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `supplier`( `name`, `phone`)  VALUES (?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $name);
            $statment->bindValue(2, $phone);

            $statment->execute();
            echo "<script> alert('تم الدخال بنجاح'); </script>";
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../custamer.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function Getsupplier()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `supplier`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function GetsupplierID($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `supplier` where `id` = '$id'";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
}