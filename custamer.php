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
        <div class="card-header">الزبائن
            <div class="team-content text-center modal-content">
                 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    أضافة
                </button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">أصافة زبون</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <h2>جديد</h2>
                                <form class="form-horizontal" action="controller/customer.php" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" placeholder="اسم الزبون">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="count" placeholder="الحساب">
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
                    <td>الحساب</td>
                    <td>كشف الحساب</td>
                </tr>
                </thead>
                <tbody>

            <?php require_once('./controller/customer.php');
            $cat = new customer();
            $result=$cat->GetCustomer();
            while ($row = $result->fetch()){
?>
                <form action="controller/customer.php" method="post" class="form">
                <td>  <input name="name" class="form-control" value="<?php echo $row['name'];?>"</td>
                <td>  <input name="count" class="form-control" value="<?php echo $row['count'];?>"</td>
<td>
             <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                    <button class="btn bg-primary" name="update" type="submit">كشف الحساب </button>
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