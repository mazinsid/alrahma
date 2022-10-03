<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');
if(isset($_POST['insert'])){
    $name=$_POST['name'];
    $cate = new catogrey();
    $cate->insertCategory($name);
}if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name=$_POST['name'];

    $cate = new catogrey();
    $cate->updateCategory($id, $name);
}
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $cate = new catogrey();
    $cate->deleteCategory($id);
}



class catogrey
{

    public function deleteCategory($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `categories` WHERE `id` = ?" ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $id);

            $statment->execute();

            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='team.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }

    public function GetCategories()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `categories`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function GetCategoriesID($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `categories` where `id` = '$id' ";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }

    public function insertCategory($name)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `categories`(`name`) VALUES (?)";
            $statment = $pdo->prepare($sql);
            $statment->bindValue(1, $name);

            $statment->execute();
            echo "<script> alert('تم الدخال بنجاح'); </script>";
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../categories.php'> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function updateCategory($id, $name)
{
    try {
        $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `categories` SET `name`='$name'WHERE `id`='$id'";
        $statment = $pdo->prepare($sql);
        $statment->execute();
        echo "<script> alert('تم الدخال بنجاح'); </script>";
        echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../categories.php'> ";
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $pdo = null;
}

}
?>