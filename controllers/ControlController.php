<?php

namespace app\controllers;


use app\models\Appeal;
use app\models\AppealAnswer;
use app\models\AppealComment;
use app\models\AppealRegister;
use app\models\Company;
use app\models\CompanyType;
use app\models\District;
use app\models\search\AppealRegisterClosedSearch;
use app\models\search\AppealRegisterDeadSearch;
use app\models\search\AppealRegisterRunningSearch;
use app\models\search\AppealRegisterSearch;
use app\models\User;
use app\models\Village;
use Mpdf\Tag\Th;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class ControlController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],

                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionMyfiles($id,$reg = 0){
        $model = AppealAnswer::findOne($id);
        if($model->status != 1){
            $comment = AppealComment::findOne(['answer_id'=>$id]);
        }else{
            $comment = new AppealComment();
            $comment->answer_id = $id;
        }


        return $this->renderAjax('_myfiles',[
            'model'=>$model,
            'comment'=>$comment,
            'reg'=>$reg
        ]);
    }


    public function actionIndex($type = null)
    {
        $user = Yii::$app->user->identity;
        if($type=='closed'){
            $searchModel = new AppealRegisterClosedSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }elseif($type == 'running'){
            $searchModel = new AppealRegisterRunningSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }elseif($type == 'dead'){
            $searchModel = new AppealRegisterDeadSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }else{
            $searchModel = new AppealRegisterSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id,$ans = 0){
        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        $answer = null;
        if($ans == 0){
            $answer = new AppealAnswer();
            $answer->appeal_id = $model->id;
            $answer->register_id = $register->id;
        }else{
            $answer = AppealAnswer::findOne($ans);
            $answer->name = $answer->bajaruvchi->name;
        }
        return $this->render('view',[
            'model'=>$model,
            'register'=>$register,
            'answer'=>$answer,
        ]);
    }


    public function actionVillage($id = null){
        if($id == null){
            $id = Yii::$app->user->identity->company->district_id;
        }
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
        return $this->render('village',[
            'model'=>$model,
            'district'=>$district,
            'res'=>$res,
        ]);
    }

    public function actionCompany($id = null){
        if($id == null){
            $id = Yii::$app->user->identity->company->district_id;
        }
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
        return $this->render('company',[
            'model'=>$model,
            'district'=>$district,
            'res'=>$res,
        ]);
    }

    public function actionDistrict($id = null){
        if($id == null){
            $id = Yii::$app->user->identity->company->region_id;
        }
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
        return $this->render('district',[
            'model'=>$model,
            'district'=>$district,
            'res'=>$res,
        ]);
    }

    public function actionCompanies($id = null){
        if($id == null){
            $id = Yii::$app->user->identity->company->region_id;
        }
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
        return $this->render('companies',[
            'model'=>$model,
            'district'=>$district,
            'res'=>$res,
        ]);
    }

    public function actionRahbar(){
        $company_id = Yii::$app->user->identity->company_id;
        $model = User::find()->where(['company_id'=>$company_id,'is_rahbar'=>1])->all();
        $res = [];
        $res[0][0] = AppealRegister::find()->andWhere(['company_id'=>$company_id])->count('id');
        $res[0][1] = AppealRegister::find()->andWhere(['company_id'=>$company_id])->andWhere(['status'=>'2'])->count('id');
        $res[0][2] = AppealRegister::find()->andWhere(['company_id'=>$company_id])->andWhere(['<>','status',2])->count('id');
        $res[0][3] = AppealRegister::find()->andWhere(['company_id'=>$company_id])->andWhere(['<>','status',2])->andWhere(['<','deadtime','date(now())'])->count('id');

        foreach ($model as $item){
            $res[$item->id][0] = AppealRegister::find()->andWhere(['ijrochi_id'=>$item->id])->count('id');
            $res[$item->id][1] = AppealRegister::find()->andWhere(['ijrochi_id'=>$item->id])->andWhere(['status'=>'2'])->count('id');
            $res[$item->id][2] = AppealRegister::find()->andWhere(['ijrochi_id'=>$item->id])->andWhere(['<>','status',2])->count('id');
            $res[$item->id][3] = AppealRegister::find()->andWhere(['ijrochi_id'=>$item->id])->andWhere('appeal_register.status <> 2 and appeal_register.deadtime<date(now())')->count('id');

        }


        return $this->render('rahbar',[
           'model'=>$model,
           'name'=>Yii::$app->user->identity->company->name,
           'res'=>$res,
        ]);
    }

    public function actionListrahbar(){

        $searchModel = new AppealRegisterSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
