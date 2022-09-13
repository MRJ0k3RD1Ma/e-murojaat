<?php

namespace app\controllers;


use app\models\AppealAnswer;
use app\models\AppealComment;
use app\models\AppealRegister;
use app\models\Company;
use app\models\CompanyType;
use app\models\District;
use app\models\Village;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class GetappealController extends Controller
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


    public function actionHodimfiles($id){
        $register = AppealRegister::findOne($id);

        return $this->renderAjax('_hodimfiles',[
            'model'=>$register,
        ]);
    }

    public function actionMyfiles($id,$reg = 0){
        $model = AppealAnswer::findOne($id);
        if($model->status != 2){
            if($comment = AppealComment::findOne(['answer_id'=>$id])){

            }else{
                $comment = new AppealComment();
                $comment->answer_id = $id;
            }
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

    public function actionPrint($id){

        $reg = AppealRegister::findOne($id);
        $path = Yii::$app->basePath.'/web/template/nazorat.docx';
        $phpword = new \PhpOffice\PhpWord\PhpWord();
        $document = $phpword->loadTemplate($path);
        $document->setValue('${company_name}', Yii::$app->user->identity->company->name);
        $document->setValue('${number}', $reg->number);
        $appeal= $reg->appeal;
        $jism = [0=>'Жасмоний шахс',1=>'Юридик шахс'];
        $document->setValue('${quest}', $appeal->question->group->code.' - '.$appeal->question->code);
        $document->setValue('${arizachi}', $appeal->person_name);
        $document->setValue('${jismyur}', $jism[$appeal->isbusinessman]);
        $document->setValue('${address}', $appeal->region->name.' '.$appeal->district->name.' '.$appeal->village->name.' '.$appeal->address);
        $document->setValue('${phone}', $appeal->person_phone);
        $document->setValue('${indate}', $reg->date);
        $document->setValue('${mc}', $appeal->count_applicant);
        $document->setValue('${shakl}', $appeal->appealShakl->name);
        $document->setValue('${turi}', $appeal->appealType->name);
        $document->setValue('${listc}', $appeal->count_list);
        if($appeal->boshqa_tashkilot == 1){
            $document->setValue('${boshqaidora}', $appeal->boshqaTashkilot->name.' '.$appeal->boshqa_tashkilot_number.' '.$appeal->boshqa_tashkilot_date);
        }else{
            $document->setValue('${boshqaidora}', ' ');
        }
        if($reg->nazorat){
            $document->setValue('${nazoratli}', 'Назоратли');
        }else{
            $document->setValue('${nazoratli}', 'Назоратсиз');
        }
        $document->setValue('${qisqacha_mazmun}', $appeal->appeal_detail);
        $document->setValue('${rahbar}', $reg->rahbar->name);
        $document->setValue('${resolution}', $reg->preview);
        $document->setValue('${bajaruvchi}', $reg->ijrochi->name);
        $document->setValue('${muddat}', $reg->deadtime);
        $document->setValue('${natijamanmun}', '');
        $document->setValue('${naz_sana}', '');
        $document->setValue('${baj_sana}', '');
        $document->setValue('${control}', '');
        $document->setValue('${donedate}', '');
        $document->setValue('${buzilgan}', '');

        /*$section = $phpword->addSection();
        $table = $section->addTable();*/



        $fileoutputname = 'myname_'.$id.'.docx';
        $fileoutputpath = Yii::$app->basePath.'/web/template/temp/' . $fileoutputname;
//сохраняешь файл
        $document->saveAs($fileoutputpath);

        return \Yii::$app->response->sendFile($fileoutputpath)
            ->on(\yii\web\Response::EVENT_AFTER_SEND, function($event) {
                unlink($event->data);
            }, $fileoutputpath);
    }

}
