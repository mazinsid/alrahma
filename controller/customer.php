<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');





if(isset($_POST['insert'])) {

    $name = $_POST['name'];
    $count = $_POST['count'];
    $ins = new customer();
    $ins->insertCustomer($name, $count);
}

class customer
{
    public function insertCustomer($name, $count)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `customer`(  `name`, `count`)  VALUES (?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $name);
            $statment->bindValue(2, $count);

            $statment->execute();
            echo "<script> alert('تم الدخال بنجاح'); </script>";
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../custamer.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function GetCustomer()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `customer`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
}