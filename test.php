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
        <div class="card-header">

                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="form-control"  type="text" placeholder="بحث" id="search">
                        <button  type="submit" onclick="searchinfo()" name="search"  class="btn btn-primary">بحث</button>
                    </div>

        </div>
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
                            <form class="form-horizontal" action="controller/item.php" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <select name="type_item">
                                            <option value="مواد بناء">مواد بناء</option>
                                            <option value="مواد كهرباء">مواد كهرباء</option>
                                            <option value="مواد سباكة">مواد سباكة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <select name="category_id">   <?php require_once('./controller/catogrey.php');
                                            $cat = new catogrey();
                                            $resultc=$cat->GetCategories();
                                            while ($rowc = $resultc->fetch()){ ?>
                                                <option value="<? echo $rowc['id'];?>"><? echo $rowc['name'];?></option>
                                            <?  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="اسم الصنف">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company" placeholder="الشركة">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="0" name="amount" placeholder="الكمية">
                                    </div>
                                </div>   <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="0" name="price" placeholder="سعر البيع">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="صورة">صورة</label>
                                    <div class="col-sm-10">
                                        <input type="file"  name="img" class="form-control" placeholder="صورة">
                                    </div>
                                </div>
                                <button class="form-control btn btn-success" type="submit" name="insert" >أصافة</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="card-body">
            <table class="table">
                <thead>
                <td>الصنف</td>
                <td>الاسم</td>
                <td>الشركة</td>
                <td>الكمية</td>

                <td>سعر البيع </td>
                <td>الصورة </td>
                <td>التحكم </td>
                </thead>
                <tbody>
                <?php require_once('./controller/item.php');
                $cat = new item();
                $name=$_GET['name'];
                $result=$cat->search($name);
                while ($row = $result->fetch()){
                    ?>
                    <tr>
                        <form action="controller/item.php" method="post" class="form">
                            <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                            <td>   <?php require_once('./controller/catogrey.php');
                                $cat = new catogrey();
                                $catogrey_id = $row['category_id'] ;
                                $resultc=$cat->GetCategoriesID($catogrey_id);
                                while ($rowc = $resultc->fetch()){
                                    echo $rowc['name'];
                                }?>
                            </td>
                            <td>   <?php echo $row['name'];?></td>
                            <td>   <?php echo $row['company'];?></td>
                            <td>    <?php echo $row['amount'];?> </td>
                            <td>    <?php echo $row['price'];?> </td>
                            <td>  <img width="100px" height="50px" src="img/item/<?php echo $row['img']; ?>"> </td>
                        </form>
                        <td>
                            <div class="team-content text-center modal-content">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalu">
                                    تعديل
                                </button>
                                <div class="modal" id="myModalu">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="controller/item.php" enctype="multipart/form-data" method="post">
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <select name="type_item">
                                                                <option value="مواد بناء" <?php if($row['type_item']=='مواد بناء') {echo 'selected';}?>>مواد بناء</option>
                                                                <option value="مواد كهرباء" <?php if($row['type_item']=='مواد كهرباء') {echo 'selected';}?>>مواد كهرباء</option>
                                                                <option value="مواد سباكة" <?php if($row['type_item']=='مواد سباكة') {echo 'selected';}?>>مواد سباكة</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <select name="category_id">   <?php require_once('./controller/catogrey.php');
                                                                $cat = new catogrey();
                                                                $resultc=$cat->GetCategories();
                                                                while ($rowc = $resultc->fetch()){ ?>
                                                                    <option value="<? echo $rowc['id'];?>" <?php if ($rowc['id']==$row['category_id']){ echo "selected" ; }?>><? echo $rowc['name'];?></option>
                                                                <?  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <input type="hidden" class="form-control" value=" <?php echo $row['id'];?>" name="id" >
                                                            <input type="text" class="form-control" value=" <?php echo $row['name'];?>" name="name" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="company" value="<?php echo $row['company'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" value="<?php echo $row['amount'] ?>" name="amount">
                                                        </div>
                                                    </div>   <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" value="<?php echo $row['price'] ?>"  name="price" >
                                                        </div>
                                                    </div>

                                                    <button class="form-control btn btn-success" type="submit" name="updateitem" >تعديل</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="js/main.js"></script>
<script>
    function searchinfo() {
    var key = document.getElementById('search').value.toString();
     search(key);
    }</script>
<script>
    function  search(key) {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("card-body").innerHTML = this.responseText;
            }
        };


        xmlhttp.open("GET","SearchItem.php?key="+key,true);
        xmlhttp.send();

    }
</script>
</html>