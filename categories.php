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
                            <div class="modal-header">
                                <h4 class="modal-title">أصافة صنف</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <h2>جديد</h2>
                                <form class="form-horizontal" action="controller/catogrey.php" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" placeholder="اسم الصنف">
                                        </div>
                                    </div>
                                    <button class="form-control btn btn-success" type="submit" name="insert" >أصافة</button>
                                </form>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <td>الاسم</td>
                    <td>تعديل</td>
                    <td>حزف</td>
                </tr>
                </thead>
                <tbody>

            <?php require_once('./controller/catogrey.php');
            $cat = new catogrey();
            $result=$cat->GetCategories();
            while ($row = $result->fetch()){
?>
                <form action="controller/catogrey.php" method="post" class="form">
                <td>  <input name="name" class="form-control" value="<?php echo $row['name'];?>"</td>
                <td>

             <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                    <button class="btn bg-primary" name="update" type="submit">تعديل </button>
         </form>
                </td>          <td>

                    <button class="btn bg-danger" name="delete" type="submit">حزف </button>
         </form>
                </td>

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