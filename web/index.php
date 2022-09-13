<?php
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/functions.php';

$config = require __DIR__ . '/../config/web.php';

function prettyNumber($num){
    $num = "{$num}";
    $n="";
    $t=strlen($num);
    for($i=0; $i<$t; $i++){
        if($i!=0 and $i%3==0){
            $n.=' ';
        }
        $n .= $num[$t-$i-1];
    }
    $res = "";
    $t = strlen($n);
    for ($i=0; $i<$t; $i++){
        $res .= $n[$t-$i-1];
    }
    return $res;
}

(new yii\web\Application($config))->run();
