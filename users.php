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
        <div class="card-header">الموظفين
            <div class="team-content text-center modal-content">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    أضافة
                </button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-conten
                        t">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">أصافة </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <h2>جديد</h2>
                                <form class="form-horizontal" action="controller/login.php" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" placeholder="اسم المستخدم">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input  class="form-control" name="password" placeholder="كلمة المرور">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select class="form-control" name="role">
                                                <option value="2">مبيعات</option>
                                                <option value="1">مدير</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="form-control btn btn-success" type="submit" name="insertuser" >أصافة</button>
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
                    <td>كلمة المرور</td>
                    <td>الوظيفة</td>
                </tr>
                </thead>
                <tbody>

                <?php require_once('./controller/login.php');
                $user = new login();
                $result=$user->GetUserAllِ();
                while ($row = $result->fetch()){
                    ?>
                    <form action="controller/login.php" method="post" class="form">
                        <td>  <input name="name" class="form-control" value="<?php echo $row['username'];?>"</td>
                        <td>  <input name="password" class="form-control" value="<?php echo $row['password'];?>"</td>
                        <td>  <input name="role" class="form-control" value="<?php echo $row['role'];?>"</td>
                        <td>
                            <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                            <button class="btn bg-primary" name="udadteuser" type="submit">تعديل  </button>
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