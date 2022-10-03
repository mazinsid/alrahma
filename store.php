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
            <div class="card-body">
                <table class="table">
                    <thead>
                    <td>الصنف</td>
                    <td>الكمية</td>
                    <td>التحكم </td>
                    </thead>
                    <tbody>
                    <?php require_once('./controller/store.php');
                    $cat = new store();
                    $result=$cat->Getstore();
                    while ($row = $result->fetch()){
                        ?>
                        <tr>
                            <form action="controller/store.php" method="post" class="form">
                                <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                                <td>   <?php require_once('./controller/item.php');
                                    $cat = new item();
                                    $item = $row['item_id'] ;
                                    $resultc=$cat->GetItemID($item);
                                    while ($rowc = $resultc->fetch()){
                                        echo $rowc['name'];
                                    }?>

                                </td>

                                <td>    <?php echo $row['amount'];?> </td>
                         </form>
                         <td>   <div class="team-content text-center modal-content">
                                 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalM">
                                     تحويل الي المحل
                                 </button>
                                 <div class="modal" id="myModalM">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                 <h4 class="modal-title"> تحويل الي المحل</h4>
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             </div>
                                             <!-- Modal body -->
                                             <div class="modal-body">
                                                 <h2>
                               <?php require_once('./controller/item.php');
                                $cat = new item();
                                $item = $row['item_id'] ;
                                $resultc=$cat->GetItemID($item);
                                while ($rowc = $resultc->fetch()){
                                    echo $rowc['name'];
                                }?>
                                                 </h2>
                                                 <form class="form-horizontal" action="controller/store.php" method="post">
                                                     <input name="type_id" value="<?php echo $row['item_id']; ?>" type="hidden">
                                                     <div class="form-group">
                                                         <div class="col-sm-10">
                                                             <input type="number" class="form-control" name="amount" placeholder="الكمية">
                                                         </div>
                                                     </div>
                                                     <button class="form-control btn btn-success" type="submit" name="toMarket" >أصافة</button>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div></td>
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