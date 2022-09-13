<?php

namespace app\controllers;

use app\models\Appeal;
use app\models\AppealAnswer;
use app\models\AppealBajaruvchi;
use app\models\AppealControl;
use app\models\AppealQuestionGroup;
use app\models\AppealRegister;
use app\models\AppealShakl;
use app\models\AppealType;
use app\models\search\AppealBajaruvchiSearch;
use app\models\search\AppealRegisterClosedSearch;
use app\models\search\AppealRegisterDeadSearch;
use app\models\search\AppealRegisterHasSearch;
use app\models\search\AppealRegisterRunningSearch;
use app\models\search\AppealRegisterSearch;
use app\models\User;
use app\models\Village;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Yii;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    public function actionIndex($date = -1){
        if($date == -1){
            $date = date('Y');
        }
        $name = $date." йилларда Хоразм вилояти ҳокимлиги раҳбарияти томонидан қабул қилинган жисмоний шахслар ва юридик шахслар вакиллари, кўриб чиқилган мурожаатлар тўғрисида маълумот";

        $report = [];
        $jami = [];
        $users = User::find()->where(['company_id'=>Yii::$app->user->identity->company_id,'is_rahbar'=>1])->all();
        $shakl = AppealShakl::find()->all();
        $jami[0] = 0;
        foreach ($shakl as $i){
            $jami[$i->id] = 0;
        }
        foreach ($users as $item){
            $report[$item->id][0] = AppealRegister::find()->where(['ijrochi_id'=>$item->id])->andFilterWhere(['like','date',date('Y')])->count();
            $jami[0] += $report[$item->id][0];
            foreach ($shakl as $i){
                $report[$item->id][$i->id] = AppealRegister::find()->where(['appeal_register.ijrochi_id'=>$item->id])->andFilterWhere(['like','appeal_register.date',$date])
                    ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')->andWhere(['appeal.appeal_shakl_id'=>$i->id])->count();
                $jami[$i->id] += $report[$item->id][$i->id];
            }
        }

        return $this->render('index',[
            'name'=>$name,
            'report'=>$report,
            'shakl'=>$shakl,
            'jami'=>$jami,
            'users'=>$users
        ]);
    }
    public function actionIndex2($date = -1){
        if($date == -1){
            $date = date('Y');
        }
        $name = $date." йилларда Хоразм вилояти ҳокимлиги раҳбарияти томонидан қабул қилинган жисмоний шахслар ва юридик шахслар вакиллари, кўриб чиқилган мурожаатлар тўғрисида маълумот";

        $group = AppealQuestionGroup::find()->all();
        $shakl = AppealShakl::find()->all();
        $control = AppealControl::find()->all();
        $jami = [];
        $report = [];
        foreach ($shakl as $item) {
            $jami[1][$item->id] = 0;
        }
        foreach ($control as $item) {
            $jami[2][$item->id] = 0;
        }
        $jami[0][0] = 0;
        $jami[3][0] = 0;
        $jami[4][0] = 0;
        $jami[5][0] = 0;
        foreach ($group as $item){

            $report[$item->id][0][0] = AppealRegister::find()
                ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')
                ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.company_id'=>Yii::$app->user->identity->company_id])->andFilterWhere(['like','date',date('Y')])->count();
            $jami[0][0] += $report[$item->id][0][0];

            $report[$item->id][3][0] = AppealRegister::find()
                ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')
                ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.nazorat'=>1,'appeal_register.company_id'=>Yii::$app->user->identity->company_id])->andFilterWhere(['like','date',date('Y')])->count();
            $jami[3][0] += $report[$item->id][3][0];

            $report[$item->id][4][0] = AppealRegister::find()
                ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')
                ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.takroriy'=>1,'appeal_register.company_id'=>Yii::$app->user->identity->company_id])->andFilterWhere(['like','date',date('Y')])->count();
            $jami[4][0] += $report[$item->id][4][0];

            $report[$item->id][5][0] = AppealRegister::find()
                ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')->where('appeal_register.deadtime<date(now()) and appeal_register.status <> 2')
                ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.company_id'=>Yii::$app->user->identity->company_id])->andFilterWhere(['like','date',date('Y')])->count();
            $jami[5][0] += $report[$item->id][5][0];


            foreach ($shakl as $i){
                $report[$item->id][$i->id][1] = AppealRegister::find()
                    ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                    ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')
                    ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.company_id'=>Yii::$app->user->identity->company_id,'appeal.appeal_shakl_id'=>$i->id])->andFilterWhere(['like','date',date('Y')])->count();;
                $jami[1][$i->id] += $report[$item->id][$i->id][1];
            }

            foreach ($control as $i){
                $report[$item->id][$i->id][2] = AppealRegister::find()
                    ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                    ->innerJoin('appeal_question','appeal_question.id=appeal.question_id')
                    ->andWhere(['appeal_question.group_id'=>$item->id,'appeal_register.company_id'=>Yii::$app->user->identity->company_id,'appeal.appeal_control_id'=>$i->id])->andFilterWhere(['like','date',date('Y')])->count();
                $jami[2][$i->id] += $report[$item->id][$i->id][2];
            }


        }

        return $this->render('index2',[
            'name'=>$name,
            'group'=>$group,
            'shakl'=>$shakl,
            'control'=>$control,
            'report'=>$report,
            'jami'=>$jami,
            'date'=>$date
        ]);
    }
}
