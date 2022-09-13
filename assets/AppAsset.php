<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        '/theme/plugins/fontawesome-free/css/all.min.css',
        '/theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
//        '//db.onlinewebfonts.com/c/758d40d7ca52e3a9bff2655c7ab5703c?family=Cambria',
//        '/theme/plugins/daterangepicker/daterangepicker.css',
//        '/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
//        '/theme/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
//        '/theme/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
//        '/theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
//        '/theme/plugins/select2/css/select2.min.css',
//        '/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        '/theme/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.css',
        '/theme/plugins/select2/css/select2.min.css',
        '/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        '/theme/plugins/datatables/jquery.dataTables.min.css',
        '/theme/plugins/datatables-buttons/css/buttons.dataTables.min.css',
        '/theme/plugins/sweetalert2/sweetalert2.min.css',
        '/theme/dist/css/style.css',
    ];
    public $js = [
//        '/theme/plugins/jquery/jquery.min.js',
        '/theme/plugins/bootstrap/js/bootstrap.bundle.min.js',
        '/theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        '/theme/dist/js/adminlte.js',
        '/theme/dist/js/demo.js',
        '/theme/plugins/jquery-mousewheel/jquery.mousewheel.js',
        '/theme/plugins/raphael/raphael.min.js',
        '/theme/plugins/jquery-mapael/jquery.mapael.min.js',
        '/theme/plugins/jquery-mapael/maps/usa_states.min.js',
        '/theme/plugins/chart.js/Chart.min.js',
//        '/theme/dist/js/pages/dashboard2.js',
        '/theme/dist/js/pages/dashboard3.js',
//        '/theme/plugins/select2/js/select2.full.min.js',
        '/theme/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
        '/theme/plugins/jquery.svg.pan.zoom/jquery.svg.pan.zoom.js',
        '/theme/plugins/select2/js/select2.min.js',
        '/theme/plugins/datatables/jquery.dataTables.min.js',
        '/theme/plugins/datatables-buttons/js/dataTables.buttons.min.js',
        '/theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',

        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
        '/theme/plugins/datatables-buttons/js/buttons.html5.min.js',
        '/theme/plugins/datatables-buttons/js/buttons.print.min.js',
//        '/theme/plugins/moment/moment.min.js',
//        '/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js',
//        '/theme/plugins/daterangepicker/daterangepicker.js',
//        '/theme/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
//        '/theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        '/theme/plugins/sweetalert2/sweetalert2.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
