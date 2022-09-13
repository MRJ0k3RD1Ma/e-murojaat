<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Жавоби келган мурожаатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-answer-index">

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <div class="table-responsive">

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'label'=>'Жавоб рақами',
                                    'value'=>function($d){
                                        $ans = \app\models\AppealAnswer::find()->where(['parent_id'=>$d->id])->orderBy(['id'=>SORT_DESC])->one();
                                        $url = Yii::$app->urlManager->createUrl(['/appeal/showresult','id'=>$d->id]);
                                        return "<a href='{$url}'>$ans->number<br>$ans->date</a>";
                                    },
                                    'format'=>'raw'
                                ],
                                [
                                    'label'=>'Хужжат номи',
                                    'value'=>function($d){
                                        $ans = \app\models\AppealAnswer::find()->where(['parent_id'=>$d->id])->orderBy(['id'=>SORT_DESC])->one();
                                        return $ans->preview;
                                    }
                                ],
                                [
                                    'label'=>'Рақами ва санаси',
                                    'value'=>function($d){
                                        return "<b>№ {$d->register->number}</b> <br> {$d->register->date}";
                                    },
                                    'format'=>'raw'
                                ],
                                [
                                    'label'=>'Мурожаатчи',
                                    'attribute'=>'appeal_id',
                                    'value'=>function($d){

                                        if($q = $d->appeal->question){
                                            $res = $q->group->code.'-'.$q->code.'.'.$q->name;
                                        }else{
                                            $res = "Савол белгиланмаган";
                                        }

                                        $url = Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$d->register->id]);

                                        $res = $d->appeal->person_name.'<br>'.$res;
                                        return "<a href='{$url}'>{$res}</a>";
                                    },
                                    'format'=>'raw',
                                    'filter'=>false
                                ],
                                [
                                    'attribute'=>'company_id',
                                    'value'=>function($d){
                                        return $d->company->name;
                                    },
                                    'filter'=>false,
                                ],
                                'task',
                                'deadtime',

                            ],
                        ]); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
