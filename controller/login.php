<?php
require_once('ConnectDBl.php');

if(isset($_POST['udadteuser'])){
    $name=$_POST['name'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $id=$_POST['id'];
    $ins=new login();
    $ins->udadteuser($name,$password, $role,$id);
}
if(isset($_POST['insertuser'])){
    $name=$_POST['name'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $ins=new login();
    $ins->insertuser($name,$password, $role);
}
if(isset($_POST['login'])){
    $name=$_POST['username'];
    $password=$_POST['pass'];
    $ins=new login();
    $ins->GetUser($name,$password);
}
if(isset($_POST['deleteuser'])){
    $id = $_POST['id'];
    $ins=new login();
    $ins->deleteuser($id);
}

class login
{

    public function deleteuser($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `user` WHERE `id` = ?" ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $id);

            $statment->execute();

            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../users.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function GetUserِ($id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `user` where `id` = '$id' ";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }    public function GetUserAllِ()
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `user`";
            $result = $pdo->query($sql);
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function GetUser($name,$password)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `user` WHERE `username` = '$name' and `password` = '$password' ";

            $stmt = $pdo->prepare($sql);

            //Bind value.
            $stmt->bindValue(':username', $name);
            $stmt->execute();

            //Fetch row.
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //If $row is FALSE.
            if($user === false){
                //Could not find a user with that username!
                //PS: You might want to handle this error in a more user-friendly manner!
                die('Incorrect username / password combination!');
            } else{
                //User account found. Check to see if the given password matches the
                //password hash that we stored in our users table.

                //Compare the passwords.

                //If $validPassword is TRUE, the login has been successful.
                if($user['password'] == $password){
                        session_start();
                    //Provide the user with a login session.
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['username'];
                    $_SESSION['logged_in'] = time();

                    //Redirect to our protected page, which we called home.php
                    header('Location: ../home.php');
                    exit;

                } else{
                    //$validPassword was FALSE. Passwords do not match.
                    die('Incorrect username / password combination!');
                }
            }

        } catch (PDOException $e) {
            die($e->getMessage());
            // we must rollback the transaction since an error occurred with insert
            $pdo->rollback();
        }
    }
    public function insertuser($name,$password, $role)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `user`(`username`, `password`, `role`) VALUES (?,?,?)" ;
            $statment = $pdo->prepare($sql);

            $statment->bindValue(1, $name);
            $statment->bindValue(2, $password);
            $statment->bindValue(3, $role);

            $statment->execute();

            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../users.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
    public function udadteuser($name,$password, $role,$id)
    {
        try {
            $pdo = new PDO(DBCONNECT, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `user` SET `username`='$name',`password`='$password',`role`='$role' WHERE `id` = '$id'" ;
            $statment = $pdo->prepare($sql);

            $statment->execute();
            echo "<script> alert('تم الدخال بنجاح'); </script>";
            echo "<META HTTP-EQUIV='Refresh' Content=0;URL='../users.php'/> ";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $pdo = null;
    }
}
?>