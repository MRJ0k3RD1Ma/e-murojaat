<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */
/* @var $ans app\models\AppealAnswer */

$this->title = $model->person_name;
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script>
    var tashkilotadd = function(){}
</script>
<div class="row">
    <div class="col-md-6">

        <?= $this->render('view/_appeal',['model'=>$model])?>

    </div>
    <div class="col-md-6">

        <?= $this->render('view/_appealer',['model'=>$model])?>

    </div>
</div>




<div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">
                        Топшириқ маълумотлари
                    </h3>
                    <?= DetailView::widget([
                        'model' => $bajaruvchi,
                        'attributes' => [
                            'deadtime',
//                            'register_id',
                            [
                                'attribute'=>'register_id',
                                'value'=>function($d){
                                    return $d->register->number.'<br>'.$d->register->date;
                                },
                                'format'=>'raw'
                            ],
                            'task',
//                            'letter',
                            [
                                'attribute'=>'letter',
                                'value'=>function($d){
                                    if($d->letter){
                                        return "<a href='/upload/{$d->letter}'>Иловани юклаб олиш</a>";
                                    }
                                    return null;
                                }
                            ],
//                            'status',
                            [
                                'attribute'=>'status',
                                'value'=>function($d){
                                    return $d->status0->name;
                                }
                            ],
                            'created',
//                            'company_id',
                            [
                                'attribute'=>'company_id',
                                'value'=>function($d){
                                    return $d->company->name;
                                }
                            ],
                        ],
                    ]) ?>

                </div>
                <?php if($answer){?>
                    <div class="col-md-6">
                        <h3 class="card-title">
                            Мурожаатнинг жавоби
                        </h3>
                        <?= DetailView::widget([
                            'model' => $answer,
                            'attributes' => [
                                'number',
                                'date',
                                'preview',
                                'detail',
                                'name',
                                [
                                    'label'=>'Назорат',
                                    'value'=>function($d){
                                        return $d->register->control->name;
                                    }
                                ],
//                                'file',
                                [
                                    'attribute'=>'file',
                                    'value'=>function($d){
                                        if($d->file){
                                            return "<a href='/upload/{$d->file}'>Жавоб хатини юклаб олиш</a>";
                                        }else{
                                            return null;
                                        }
                                    },
                                    'format'=>'raw'
                                ],
//                                'reaply_send',
                                [
                                    'attribute'=>'reaply_send',
                                    'value'=>function($d){
                                        if($d->reaply_send == 0){
                                            return "Мурожаатчига жавоб хати юборилган";
                                        }else{
                                            return "Мурожаатчига жавоб хати юборилмаган";
                                        }
                                    }
                                ],
//                                'status'
                                [
                                    'attribute'=>'status',
                                    'value'=>function($d){
                                        return $d->status0->name;
                                    }
                                ],
                            ],
                        ]) ?>

                    </div>
                <?php }?>
            </div>

            <hr>
            <?php if($answer->status == 3 and $answer->parent->sender_id == Yii::$app->user->id){?>
            <div id="accordion">
                <a href="#success" class="btn btn-primary"  data-toggle="collapse">Умумий жавоб сифатида қабул қилиш</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/acceptanswer','id'=>$answer->id])?>"
                   data-method="post" data-confirm="Сиз ростдан ҳам ушбу жавобни қабул қилмоқчимисиз?"
                   class="btn btn-success">Қабул қилиш</a>
                <a href="#deni" class="btn btn-danger" data-toggle="collapse">Рад этиш</a>

                <div id="success" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #28a745;" data-parent="#accordion">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">
                                Қуйи ташкилот юборган жавобни умумий жавоб сифатида қабул қилиш
                            </h3>
                        </div>
                    </div>
                    <?php if($register->status != 4){?>
                        <?php if($register->parent_bajaruvchi_id){
                            echo $this->render('view/_answerform',['model'=>$answer]);
                        }else{
                            echo  $this->render('view/_closeform',['model'=>$model,'register'=>$register,'answer'=>$answer]);} ?>
                    <?php }else{echo "Мурожаатга жавоб юборилган";}?>

                </div>

                <div id="deni" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #dc3545;" data-parent="#accordion">

                    <?php
                    $com = new \app\models\AppealComment();
                    $com->answer_id = $answer->id;
                    $com->status = 6;
                    $form = ActiveForm::begin();?>
                        <?= $form->field($com,'comment')->textInput()->textInput()->label('Изоҳ')?>
                        <button class="btn btn-success" type="submit">
                            Жавобни рад қилиш
                        </button>
                    <?php ActiveForm::end()?>

                </div>

            </div>
            <?php }?>

        </div>


    </div>
