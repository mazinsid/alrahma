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
            <div class="team-content text-center modal-content">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    أضافة
                </button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="form-horizontal" action="controller/coming.php" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select name="supplier_id">   <?php require_once('./controller/supplier.php');
                                                $cat = new supplier();
                                                $resultc=$cat->Getsupplier();
                                                while ($rowc = $resultc->fetch()){ ?>
                                                    <option value="<? echo $rowc['id'];?>"><? echo $rowc['name'];?></option>
                                                <?  } ?>
                                            </select>
                                        </div>
                                    </div>    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select name="item_id">   <?php require_once('./controller/item.php');
                                                $cat = new item();
                                                $resultc=$cat->Getitem();
                                                while ($rowc = $resultc->fetch()){ ?>
                                                    <option value="<? echo $rowc['id'];?>"><? echo $rowc['name'];?></option>
                                                <?  } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control"  name="amount" placeholder="الكمية">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pirce" placeholder=" سعر الوحدة الواحدة">
                                        </div>
                                    </div>
                                     <input type="hidden" value="<?php echo date('y/m/d',time());?>" name="Date_Time">

                                    <button class="form-control btn btn-success" type="submit" name="insert" >أصافة</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <td>الصنف</td>
                    <td>الاسم</td>
                    <td>الشركة</td>
                    <td>الكمية</td>
                    <td>سعر الشراء</td>
                    <td>سعر البيع</td>
                    <td>الصورة </td>
                    <td>التحكم </td>
                    </thead>
                    <tbody>
                    <?php require_once('./controller/coming.php');
                    $cat = new coming();
                    $result=$cat->Getcoming();
                    while ($row = $result->fetch()){
                        ?>
                        <tr>
                            <form action="controller/coming.php" method="post" class="form">
                                <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                                <td>   <?php require_once('./controller/supplier.php');
                                    $cat = new supplier();
                                    $id = $row['supplier_id'] ;
                                    $resultc=$cat->GetsupplierID($id);
                                    while ($rowc = $resultc->fetch()){
                                        echo $rowc['name'];
                                    }?>

                                </td>
                                <td>
                                    <?php require_once('./controller/item.php');
                                    $cat = new item();
                                    $id = $row['item_id'] ;
                                    $resultc=$cat->GetItemID($id);
                                    while ($rowc = $resultc->fetch()){
                                        echo $rowc['name'];
                                    }?></td>
                                <td>    <?php echo $row['amount'];?> </td>
                                <td><?php echo $row['pirce'];?></td>
                                <td><?php echo $row['total'];?></td>
                                <td><?php echo $row['dateTime'];?></td>
                            </form>
                            <td>
                                <form action="controller/catogrey.php" method="post" class="form">
                                    <div class="form-group">
                                        <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                                        <button class="btn bg-primary btn-sm form-control" name="update" type="submit">تعديل </button>
                                    </div>
                                </form>
                                <div class="team-content text-center modal-content">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalM">
                                        تحويل الي المخزن
                                    </button>
                                    <div class="modal" id="myModalM">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">أصافة صنف</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <h2><?php echo $row['name']; ?></h2>
                                                    <form class="form-horizontal" action="controller/store.php" method="post">
                                                        <input name="type_id" value="<?php echo $row['id']; ?>" type="hidden">
                                                        <div class="form-group">
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control" name="amount" placeholder="الكمية">
                                                            </div>
                                                        </div>
                                                        <button class="form-control btn btn-success" type="submit" name="toStore" >أصافة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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