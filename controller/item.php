<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');





if(isset($_POST['insert'])){
    $type_item = $_POST['type_item'];
    $category_id = $_POST['category_id'];
    $name=$_POST['name'];
    $company=$_POST['company'];
    $amount=$_POST['amount'];
    $price=$_POST['price'];
    $img = $_FILES['img']['name'];
    $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'].$directory_self."../img/item/";
    $uploadDirectory .= $img;
    move_uploaded_file($_FILES['img']['tmp_name'], $uploadDirectory);
    $ins=new item();
    $ins->InsertItem($type_item, $category_id ,$name,$company,$amount,$price,$img);
}

if(isset($_POST['updateitem'])){
    $id = $_POST['id'];
    $type_item = $_POST['type_item'];
    $category_id = $_POST['category_id'];
    $name=$_POST['name'];
    $company=$_POST['company'];
    $amount=$_POST['amount'];
    $price=$_POST['price'];
    $ins=new item();
    $ins->updateitem($id,$type_item, $category_id ,$name,$company,$amount,$price);
}
if(isset($_POST['deleteitem'])){
    $id = $_POST['id'];
    $ins=new item();
    $ins->deleteitem($id);
}
if(isset($_POST['search'])){
    $name = $_POST['name'];
    $ins=new item();
    $ins->search($name);
}

class item
{

    public function search($name)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `item` WHERE `name` like '%$name%' " ;
            $result = $pdo->query($sql);
            return $result;

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function deleteitem($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `item` WHERE `id` = ?" ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $id);

            $statment->execute();

            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='item.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }

    public function Getitem()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `item`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }

    public function GetItemCategory($category_id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `item` WHERE `category_id` = '$category_id'";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
        $pdo = null;
    }
    public function GetItemID($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `item` WHERE `id` = '$id'";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
        $pdo = null;
    }
    public function InsertItem($type_item, $category_id ,$name,$company,$amount,$price,$img)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `item`( `type_item`, `category_id`, `name`, `company`, `amount`, `price`, `img`)
            VALUES (?,?,?,?,?,?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $type_item);
            $statment->bindValue(2, $category_id);
            $statment->bindValue(3, $name);
            $statment->bindValue(4, $company);
            $statment->bindValue(5, $amount);
            $statment->bindValue(6, $price);
            $statment->bindValue(7, $img);

            $statment->execute();
            echo "<script> alert('تم الدخال بنجاح'); </script>";
           echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../item.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function updateitem($id,$type_item, $category_id ,$name,$company,$amount,$price)
{
    try {
        $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `item` SET `type_item`='$type_item',`category_id`='$category_id',`name`='$name',`company`='$company',
            `amount`='$amount',`price`='$price' WHERE `id`='$id'";
        $statment = $pdo->prepare($sql);
        $statment->execute();
        echo "<script> alert('تم الدخال بنجاح'); </script>";
        echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../item.php'> ";
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $pdo = null;
}

}
?>