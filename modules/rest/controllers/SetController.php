<?php

namespace app\modules\rest\controllers;

use app\models\Appeal;
use app\models\AppealBajaruvchi;
use app\models\AppealRegister;
use app\models\Company;
use yii\rest\ActiveController;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `rest` module
 */
class SetController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionSet(){
        $model = new Appeal();
        if($model->load(Yii::$app->request->post())){

            if($comp = Company::find()->where(['type_id'=>3])->andWhere(['district_id'=>$model->district_id])->one()){
                $model->company_id = $comp->id;
            }else{
                $comp = Company::find()->where(['type_id'=>1])->andWhere(['region_id'=>$model->region_id])->one();
                $model->company_id = $comp->id;
            }
            if($model->save()){
                $baj = new AppealBajaruvchi();
                $baj->appeal_id = $model->id;
                $baj->company_id = $model->company_id;
                $baj->deadtime = date('Y-m-d',strtotime($model->created.' +15 days'));
                $baj->deadline = 15;
                $baj->status = 0;
                $baj->save();
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo -1;
        }
        exit;
    }

}
