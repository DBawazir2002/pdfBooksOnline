<?php
session_start();
require_once 'dashboard/include/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كتب pdf</title>
    <!-- Bootstrab css-->
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <!-- Bootstrab RTL-->
    <link rel="stylesheet" href="layout/css/bootstrap-rtl.css">
    <!-- Custom css-->
    <link rel="stylesheet" href="layout/css/custom.css">
</head>

<body>
    <!-- Start navbar-->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a href="index.php" class="navbar-brand">كتب pdf</a>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collpase navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li class="navbar-itm">
                        <a href="dashboard/" class="nav-link">تسجيل الدخول</a>
                    </li>
                    <li class="navbar-itm">
                        <a href="index.php" class="nav-link">الرئيسية</a>
                    </li>
                    <li class="navbar-itm">
                        <a href="category.php" class="nav-link">التصنيفات</a>
                    </li>
                    <li class="navbar-itm">
                        <a href="#" class="nav-link">تواصل معنا</a>
                    </li>


                    <?php
                    if (isset($_SESSION['adminInfo'])) {
                    ?>
                        <a href="dashboard/dashboard.php" target="_blank" id="dashboard-btn">لوحة التحكم</a>

                    <?php
                    }

                    ?>

                    <li class="navbar-itm">
                        <div class="container" style="margin-top: 5px;">
                            <form action="search.php" method="GET">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="search" placeholder="ابحث عن اسم الكتاب او الكاتب" style="width: 300px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search" name="btn-submit">ابحث</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                </ul>
            </div>
        </div>



    </nav>