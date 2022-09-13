<?php

namespace app\controllers;


use app\models\CompanyType;
use app\models\District;
use app\models\KasanachiTutzorSxema;
use app\models\Village;
use yii\web\Controller;


class SetController extends Controller
{
    public function actionAppeal(){
        var_dump($_SERVER['previous_location']);
        exit;
    }
}
