<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DeadlineChangesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Муддат узайтиришга сўровлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deadline-changes-index">

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute'=>'detail',
                                'value'=>function($d){
                                    $res = mb_substr($d->detail,0,100);
                                    $url = Yii::$app->urlManager->createUrl(['/appeal/viewrequest','id'=>$d->id]);
                                    return "<a href='{$url}'>{$res}</a>";
                                },
                                'format'=>'raw'
                            ],

                            [
                                'attribute'=>'type_id',
                                'value'=>function($d){
                                    return $d->type->name;
                                }
                            ],
                            [
                                'label'=>'Рақами ва санаси',
                                'value'=>function($d){
                                    if($d->register){
                                        return "<b>№ {$d->register->number}</b> <br> {$d->register->date}";
                                    }
                                    return null;
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
                                    $url = "";
                                    if($d->register){
                                        if($d->register->parent_bajaruvchi_id){
                                            $url = Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$d->register->parent->register_id]);
                                        }else{
                                            $url = Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$d->register->id]);
                                        }
                                    }


                                    $res = $d->appeal->person_name.'<br>'.$res;
                                    return "<a href='{$url}'>{$res}</a>";
                                },
                                'format'=>'raw',
                                'filter'=>false
                            ],
                            [
                                'attribute'=>'sender_id',
                                'value'=>function($d){
                                    if($d->sender->company_id == Yii::$app->user->identity->company_id){
                                        return $d->sender->name;
                                    }
                                    return $d->sender->company->name;
                                }
                            ],
                            [
                                'attribute'=>'file',
                                'value'=>function($d){
                                    if($d->file){
                                        return "<a href='/upload/{$d->file}' target='_blank'>Иловани юклаб олиш</a>";
                                    }
                                    return "Илова мавжуд эмас";
                                },
                                'format'=>'raw'
                            ],
                            [
                                'attribute'=>'status_id',
                                'value'=>function($d){return $d->status->name;},
                                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\RequestStatus::find()->all(),'id','name')
                            ],
                            //'ads',
                            'created',
                            //'updated',
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>



</div>
