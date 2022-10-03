<meta charset="utf-8">
<?php
require_once('ConnectDBl.php');
if(isset($_POST['insertOutgoing'])){
    $note=$_POST['note'];
    $how=$_POST['how'];
    $DateTime=$_POST['DateTime'];
    $ins=new Outgoing();
    $ins->insertOutgoing($note,$how, $DateTime);
}
class Outgoing
{

    public function insertOutgoing($note,$how, $DateTime)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `Outgoing`( `note`, `how`, `DateTime`)  VALUES (?,?,?)" ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $note);
            $statment->bindValue(2, $how);
            $statment->bindValue(3, $DateTime);

            $statment->execute();

            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../Outgoing.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function GetOutgoing()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `Outgoing`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
}