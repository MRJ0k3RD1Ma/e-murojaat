<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php $this->beginBody() ?>
<script>
    function filter() {

    }
    function close_modal() {

    }
    function person_export() {

    }
    function close_export() {

    }

</script>

<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block align-center">
                <a href="/" class="nav-link">
                    "E-PILLA" axborot tizimi
                </a>
            </li>

        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <li class="nav-item">
                <?=Html::a('<i class="fa fa-door-open"></i> Chiqish',['/site/logout'],[
                    'class'=>'nav-link',
                    'data' => [
                        'confirm' => Yii::t('app', 'Haqiqatdan ham dasturdan chiqmoqchimisiz?'),
                        'method' => 'post',
                    ],
                ])?>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary">
        <!-- Brand Logo -->
        <div align="center">
            <br />
            <img src="/logo_2.png" style="max-width: 80%;width: 100px;" alt="Aholi logo" />
            <br />
            <div style="padding: 10px;" class="brand-text text-white">
                "E-PILLA" avtomatlashtirilgan kasalachilik monitoringi axborot tizimi
            </div>
        </div>
        <hr />

        <!-- Sidebar -->
        <div class="sidebar">

            <?=$this->render('_menu')?>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?=$this->render('_brandcrubs')?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
               <?=$content?>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer hidden-sm hidden-xs">
        <strong>&copy; "E-PILLA.UZ" axborot tizimi <a href="http://">"Рақамли иқтисодиётни ривожлантириш" МЧЖ</a> tomonidan ishlab chiqilgan.</strong>
        Barcha huquqlar himoyalangan.

    </footer>
</div>
<?php //
//$controller=Yii::$app->controller->id;
//$action=Yii::$app->controller->action->id;
//if($controller=='site' && $action=='index')
//echo '<script src="/theme/dist/js/pages/dashboard2.js"></script>';
//echo '<script src="/theme/dist/js/pages/dashboard2.js"></script>';
//
//?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
