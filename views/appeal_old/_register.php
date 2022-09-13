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
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Муожаат маълумотлари
                </h3>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'appeal_detail',
//                        'appeal_file',
                        [
                            'attribute'=>'appeal_file',
                            'value'=>function($d){
                                if($d->appeal_file){
                                    return "<a href='/upload/{$d->appeal_file}'>Иловани юклаб олиш</a>";
                                }else{
                                    return null;
                                }
                            },
                            'format'=>'raw'
                        ],
//                        'deadtime',

                        'updated',
//                        'boshqa_tashkilot',
                        [
                            'attribute'=>'question_id',
                            'value'=>function($d){
                                if($d->question_id){
                                    $q = $d->question;
                                    return $q->group->code.'-'.$q->code.'.'.$q->name;
                                }
                                return null;
                            },
                        ],
                        [
                            'attribute'=>'appeal_shakl_id',
                            'value'=>function($d){
                                return $d->appealShakl->name;
                            },
                        ],
                        [
                            'attribute'=>'appeal_type_id',
                            'value'=>function($d){
                                return $d->appealType->name;
                            },
                        ],
                        [
                            'label'=>'Қабул қилган ташкилот',
                            'attribute'=>'boshqa_tashkilot',
                            'value'=>function($d){
                                if($d->boshqa_tashkilot){
                                    return $d->boshqaTashkilot->name.'<br>'.$d->boshqa_tashkilot_number.' '.$d->boshqa_tashkilot_date;
                                }else{
                                    return "Бевосита";
                                }
                            }
                        ],
                        [
                            'label'=>'Масуъл ташкилот',
                            'attribute'=>'company_id',
                            'value'=>function($d){
                                return $d->company->name;
                            }
                        ],

                    ],
                ]) ?>


            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Мурожаатчи ҳақида
                </h3>
            </div>
            <div class="card-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                        'id',
                        'person_name',
                        'person_phone',
                        'date_of_birth',
//                        'gender',
                        [
                            'attribute'=>'gender',
                            'value'=>function($d){
                                return Yii::$app->params['gender'][$d->gender];
                            }
                        ],
                        [
                            'attribute'=>'region_id',
                            'value'=>function($d){
                                return $d->region->name;
                            }
                        ],
                        [
                            'attribute'=>'district_id',
                            'value'=>function($d){
                                return $d->district->name;
                            }
                        ],
                        [
                            'attribute'=>'village_id',
                            'value'=>function($d){
                                return $d->village->name;
                            }
                        ],
                        'address',
                        'email',
                        'businessman',
                    ],
                ]) ?>


            </div>
        </div>
    </div>
</div>




<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header">
                    <h3 class="card-title">
                        Ариза маълумотлари
                    </h3>
                </div>
                <?= DetailView::widget([
                    'model' => $register,
                    'attributes' => [
                        'number',
                        'date',
//                        'deadtime',
                        [
                            'attribute'=>'deadtime',
                            'value'=>function($d){
                                return $d->deadline.' кун '.$d->deadtime;
                            }
                        ],
                        'donetime',
//                        'control_id',
                        [
                            'attribute'=>'control_id',
                            'value'=>function($d){
                                return $d->control->name;
                            }
                        ],
//                        'status',
                        'preview',
//                        'detail',
//                        'file',
//                        'nazorat',
                        [
                            'attribute'=>'nazorat',
                            'value'=>function($d){
                                return Yii::$app->params['nazorat'][$d->nazorat];
                            }
                        ],
//                        'takroriy',
//                        'rahbar_id',
//                        'ijrochi_id',
                        [
                            'attribute'=>'rahbar_id',
                            'value'=>function($d){
                                return @$d->rahbar->name;
                            }
                        ],
                        [
                            'attribute'=>'ijrochi_id',
                            'value'=>function($d){
                                return @$d->ijrochi->name;
                            }
                        ],
                    ],
                ]) ?>

            </div>

            <div class="col-md-6">
                <div class="card-header">
                    <h3 class="card-title">
                        Топшириқ маълумотлари
                    </h3>
                </div>

                <?= DetailView::widget([
                    'model' => $baj,
                    'attributes' => [
//                        'company_id',
                        [
                            'label'=>'Юборувчи ташкилот',
                            'value'=>function($d){
                                return @$d->register->company->name;
                            },
                        ],
                        'deadline',
                        'deadtime',
                        'created',
//                        'status',
                        [
                            'attribute'=>'status',
                            'value'=>function($d){
                                return $d->status0->name;
                            }
                        ],
                        'task',
//                        'letter'
                        [
                            'attribute'=>'letter',
                            'value'=>function($d){
                                if($d->letter){

                                }
                                return null;
                            },
                            'format'=>'raw'
                        ],
                    ],
                ]) ?>

            </div>

        </div>

        <hr>
        <div id="accordion">

            <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/getappeal','id'=>$register->id])?>" class="btn btn-default" id="downappeal"><span class="fa fa-download"></span> Мурожаат масаласини юклаб олиш</a>

            <a href="#success" class="btn btn-success" data-toggle="collapse"><span class="fa fa-check"></span> Мурожаатни қабул қилиш</a>
            <a href="#route" class="btn btn-primary" data-toggle="collapse"><span class="fa fa-route"></span> Қуйи ташкилотга юбориш</a>
            <a href="#cancel" class="btn btn-danger" data-toggle="collapse"><span class="fa fa-times"></span> Мурожаатни бошқа давлат органига юборишни сўраш</a>

            <div id="success" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #28a745;" data-parent="#accordion">
                <?php $form = ActiveForm::begin()?>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">Мурожаатни рўйхатга олиш</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($reg,'number')->textInput()?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($reg,'date')->textInput(['type'=>'date'])?>
                            </div>
                        </div>
                        <?= $form->field($reg,'preview')->textarea(['style'=>'min-height:68px'])?>

                        </div>
                    <div class="col-md-6">
                        <?= $form->field($reg,'rahbar_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'))?>

                        <?= $form->field($reg,'ijrochi_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'),['prompt'=>'Масъул ижрочини танланг'])?>


                    </div>

                    <button class="btn btn-success">Қабул қилиш</button>
                </div>

                <?php ActiveForm::end() ?>
            </div>


            <div id="route" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #007bff;" data-parent="#accordion">

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">Мурожаатни рўйхатга олиш</h3>
                    </div>
                </div>
                <h4><span class="fa fa-exclamation-triangle" style="color:#ffc107"></span> Мурожаатни қуйи ташкилотга йўналтириш функцияси яратилиш жараёнида</h4>

            </div>

            <div id="cancel" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #dc3545;" data-parent="#accordion">

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">Мурожаатни бошқа давлат органига юборишни сўраш</h3>
                    </div>
                </div>
                <h4><span class="fa fa-exclamation-triangle" style="color:#ffc107"></span> Мурожаатни бошқа давлат органига юборишни сўраш функцияси яратилиш жараёнида</h4>


            </div>

        </div>






    </div>


</div>
