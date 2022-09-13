<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealBajaruvchiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $company \app\models\Company */

$this->title = $company->name.'га юборилган мурожаатлар рўйхати';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-bajaruvchi-index">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="" class="btn btn-danger" data-method="post"><span class="fa fa-file-excel"></span> Эхпорт</a>
                    </div>
                </div>
                <div class="card-body">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'label'=>'Ҳолати',
                                'value'=>function($d){
                                    return $d->status0->name;
                                },
                                'format'=>'raw'
                            ],
                            [
                                'attribute'=>'appeal_id',
                                'value'=>function($d){

                                    if($q = $d->appeal->question){
                                        $res = $q->group->code.'-'.$q->code.'.'.$q->name;
                                    }else{
                                        $res = "Савол белгиланмаган";
                                    }

                                    $url = Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$d->register_id]);

                                    $res = $d->appeal->person_name.'<br>'.$res;
                                    return "<a href='{$url}'>{$res}</a>";
                                },
                                'format'=>'raw',
                            ],
                            'deadtime',
                            'created',
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>



</div>
