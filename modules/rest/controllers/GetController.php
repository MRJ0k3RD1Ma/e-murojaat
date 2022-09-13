<?php

namespace app\modules\rest\controllers;
use app\models\Company;
use app\models\Village;
use Yii;
use app\models\Appeal;
use app\models\AppealRegister;
use app\models\District;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `rest` module
 */
class GetController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAppeal($company_id){
        echo AppealRegister::find()->where(['company_id'=>$company_id])->count('id');
        exit;
    }
    public function actionAppealclosed($company_id){
        echo AppealRegister::find()->where(['company_id'=>$company_id])->andWhere(['status'=>2])->count('id');
        exit;
    }
    public function actionAppealrunning($company_id){
        echo AppealRegister::find()->where(['company_id'=>$company_id])->andWhere(['<>','status',2])->count('id');
        exit;
    }
    public function actionAppealdead($company_id){
        echo AppealRegister::find()->where(['company_id'=>$company_id])->andWhere(['<>','status',2])->andWhere(['<','deadtime',date('Y-m-d')])->count('id');
        exit;
    }

    public function actionDistrict($id){
        $model = District::find()->where(['region_id'=>$id])->all();
        $district = District::find()->where(['region_id'=>$id])->one();
        $res = [];
        $res[0][0] =0;
        $res[0][1] = 0;
        $res[0][2] = 0;
        $res[0][3] = 0;

        foreach ($model as $item){
            $res[$item->id][0] = Appeal::find()->where(['district_id'=>$item->id])->count('id');
            $res[$item->id][1] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['status'=>'2'])->count('id');
            $res[$item->id][2] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['<>','status',2])->count('id');
            $res[$item->id][3] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');

            $res[0][0] +=$res[$item->id][0];
            $res[0][1] +=$res[$item->id][1];
            $res[0][2] +=$res[$item->id][2];
            $res[0][3] +=$res[$item->id][3];
        }
        $m = new District();
        echo json_encode([
            'res'=>$res
        ]);
        exit;
    }

    public function actionVillage($id){
        $model = Village::find()->where(['district_id'=>$id])->all();
        $district = District::findOne($id);
        $res = [];
        $res[0][0] = Appeal::find()->where(['district_id'=>$id])->count('id');
        $res[0][1] = Appeal::find()->where(['district_id'=>$id])->andWhere(['status'=>'2'])->count('id');
        $res[0][2] = Appeal::find()->where(['district_id'=>$id])->andWhere(['<>','status',2])->count('id');
        $res[0][3] = Appeal::find()->where(['district_id'=>$id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');

        foreach ($model as $item){
            $res[$item->id][0] = Appeal::find()->where(['village_id'=>$item->id])->count('id');
            $res[$item->id][1] = Appeal::find()->where(['village_id'=>$item->id])->andWhere(['status'=>'2'])->count('id');
            $res[$item->id][2] = Appeal::find()->where(['village_id'=>$item->id])->andWhere(['<>','status',2])->count('id');
            $res[$item->id][3] = Appeal::find()->where(['village_id'=>$item->id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');
        }
        echo json_encode(['res'=>$res]);
        exit;
    }

    public function actionCompanies($id){

        $model = District::find()->where(['region_id'=>$id])->all();
        $district = District::find()->where(['region_id'=>$id])->one();
        $res = [];
        $res[0][0] =0;
        $res[0][1] = 0;
        $res[0][2] = 0;
        $res[0][3] = 0;

        foreach ($model as $item){
            $res[$item->id][0] = Appeal::find()->where(['district_id'=>$item->id])->count('id');
            $res[$item->id][1] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['status'=>'2'])->count('id');
            $res[$item->id][2] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['<>','status',2])->count('id');
            $res[$item->id][3] = Appeal::find()->where(['district_id'=>$item->id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');

            $res[0][0] +=$res[$item->id][0];
            $res[0][1] +=$res[$item->id][1];
            $res[0][2] +=$res[$item->id][2];
            $res[0][3] +=$res[$item->id][3];
        }
        echo json_encode(['res'=>$res]);
    }

    public function actionCompany($id){

        $model = Company::find()->where(['district_id'=>$id])->all();
        $district = District::findOne($id);
        $res = [];
        $res[0][0] =0;
        $res[0][1] = 0;
        $res[0][2] = 0;
        $res[0][3] = 0;

        foreach ($model as $item){
            $res[$item->id][0] = Appeal::find()->where(['company_id'=>$item->id])->count('id');
            $res[$item->id][1] = Appeal::find()->where(['company_id'=>$item->id])->andWhere(['status'=>'2'])->count('id');
            $res[$item->id][2] = Appeal::find()->where(['company_id'=>$item->id])->andWhere(['<>','status',2])->count('id');
            $res[$item->id][3] = Appeal::find()->where(['company_id'=>$item->id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');

            $res[0][0] +=$res[$item->id][0];
            $res[0][1] +=$res[$item->id][1];
            $res[0][2] +=$res[$item->id][2];
            $res[0][3] +=$res[$item->id][3];
        }
       echo json_encode(['res'=>$res]);
    }
}
