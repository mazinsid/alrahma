<!DOCTYPE html>
<html lang="en">
<head>
    <title>SEL</title>
</head>
<body>
<header>
    <?php
    require('nev.php');
    ?>
</header>
<div class="main" dir="rtl">
    <div class="card">
        <div class="card-header">الاصناف
            <td>   <div class="team-content text-center modal-content">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalM">
                      الراجع
                    </button>
                    <div class="modal" id="myModalM">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h2>

                                    </h2>
                                    <form class="form-horizontal" action="controller/back.php" method="post">
                                        <input name="user_id" value="<?php echo $_SESSION['user_id']; ?>" type="hidden">
                                        <input name="DateTime" value="<?php echo date('y/m/d');?>" type="hidden">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <select name="item_id">
                                                <?php require_once('./controller/item.php');
                                                $cat = new item();
                                                $resultc=$cat->Getitem();
                                                while ($rowc = $resultc->fetch()){
                                                 ?><option  value="<?php  echo $rowc['id']; ?>"><?php  echo $rowc['name']; ?></option>
                                              <?php  }?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="amount" placeholder="الكمية">
                                            </div>
                                        </div>
                                        <button class="form-control btn btn-success" type="submit" name="toback" >أصافة</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></td>

        </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <td>الموظف</td>
                    <td>الصنف</td>
                    <td>الكمية</td>
                    <td>التاريخ</td>
                    <td>التحكم </td>
                    </thead>
                    <tbody>
                    <?php require_once('./controller/back.php');
                    $cat = new back();
                    $result=$cat->Getback();
                    while ($row = $result->fetch()){
                        ?>
                        <tr>
                            <form action="controller/store.php" method="post" class="form">
                                <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                                <td>   <?php require_once('./controller/login.php');
                                    $cat = new login();
                                    $user = $row['user_id'] ;
                                    $resultc=$cat->GetUserِ($user);
                                    while ($rowc = $resultc->fetch()){
                                        echo $rowc['username'];
                                    }?>

                                </td>
                                <td>   <?php require_once('./controller/item.php');
                                    $cat = new item();
                                    $item = $row['item_id'] ;
                                    $resultc=$cat->GetItemID($item);
                                    while ($rowc = $resultc->fetch()){
                                        echo $rowc['name'];
                                    }?>

                                </td>

                                <td>    <?php echo $row['amount'];?> </td>
                                <td>    <?php echo $row['DateTime'];?> </td>
                            </form>
                                 </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>