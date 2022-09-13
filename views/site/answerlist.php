<?php

$this->title = "Жавоблар рўйхати";
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><?php
$this->title = "Менга келган топшириқлар рўйхати";
?>
<?php

use app\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$user = Yii::$app->user->identity;
?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">



            <div class="collapse" id="collapseExample">
                <h4>Қидирув</h4>
                <hr>

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                ]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($searchModel,'number')->textInput()?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel,'date')->textInput(['type'=>'date'])?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $quest = [];
                        foreach (\app\models\AppealQuestionGroup::find()->all() as $item) {
                            $quest[$item->code.'-'.$item->name] = [];
                            foreach ($item->question as $i){
                                $quest[$item->code.'-'.$item->name][$i->id] = $item->code.' '.$i->code.')'.$i->name;
                            }
                        }
                        ?>

                        <?= $form->field($searchModel, 'question_id')->dropDownList($quest,['prompt'=>'Саволни танланг','class'=>'form-control js-select2'])->label('Саволни танланг') ?>

                    </div>

                    <div class="col-md-4">
                        <?= $form->field($searchModel,'person_name')->textInput()->label('ФИО')?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'date_of_birth')->textInput(['type'=>'date'])->label('Туғилган санаси') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'gender')->dropDownList([0=>'Аёл',1=>'Эркак'],['prompt'=>'Жинсини танланг'])->label('Жинси') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'person_phone')->textInput(['maxlength' => true])->label('Телефон рақами') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name'),['prompt'=>'Вилоятни танланг',
                            'onchange'=>'
				$.get( "'.\yii\helpers\Url::toRoute('/get/district').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($searchModel, 'district_id').'" ).html( data );
                            });
			'
                        ])->label('Вилоят номи') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\District::find()->where(['region_id'=>$searchModel->region_id])->all(),'id','name'),['prompt'=>'Туманни танланг',
                            'onchange'=>'
				            $.get( "'.\yii\helpers\Url::toRoute('/get/village').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($searchModel, 'village_id').'" ).html( data );
                            });
			'
                        ])->label('Туман номи') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'village_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Village::find()->where(['district_id'=>$searchModel->district_id])->all(),'id','name'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2'])->label('Маҳалла номи') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'address')->textInput(['maxlength' => true])->label('Манзил') ?>
                    </div>


                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'control_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AppealControl::find()->all(),'id','name'),[
                            'prompt'=>'Назорат турини танланг'
                        ]) ?>
                    </div>




                </div>

                <div class="form-group">
                    <?= Html::submitButton('Қидириш', ['class' => 'btn btn-primary']) ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/index'])?>" class="btn btn-outline-secondary">Тозалаш</a>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?= $this->title?>
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="fa fa-search"></span> Қидирув
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'label'=>'Рақами ва санаси',
                                            'value'=>function($d){
                                                return "<b>№ {$d->number}</b> <br> {$d->date}";
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

                                                $url = Yii::$app->urlManager->createUrl(['/site/view','id'=>$d->id]);

                                                $res = $d->appeal->person_name.'<br>'.$res;
                                                return "<a href='{$url}'>{$res}</a>";
                                            },
                                            'format'=>'raw',
                                        ],
                                        [
                                            'attribute'=>'rahbar_id',
                                            'value'=>function($d){
                                                return isset($d->rahbar) ? $d->rahbar->name : '';
                                            }
                                        ],
                                        [
                                            'attribute'=>'ijrochi_id',
                                            'value'=>function($d){
                                                return isset($d->ijrochi) ? $d->ijrochi->name : '';
                                            }
                                        ],

                                        [
                                            'attribute'=>'control_id',
                                            'value'=>function($d){
                                                return $d->control->name;
                                            }
                                        ],

                                        [
                                            'attribute'=>'deadtime',
                                            'value'=>function($d){
                                                if($d->status == 2){
                                                    return "<span class='bg-success' style='width: 100%; height: 100%; display: block;text-align: center'>Бажарилган</span>";
                                                }
                                                $ans = isset($d->user_answer) ? json_decode($d->user_answer,true) : [];
                                                if(is_array($ans) and in_array(Yii::$app->user->id,$ans)){
                                                    return "<span class='bg-success' style='width: 100%; height: 100%; display: block;text-align: center'>Бажарилган</span>";
                                                }
                                                $datetime2 = date_create($d->deadtime);
                                                $datetime1 = date_create(date('Y-m-d'));

                                                $interval = date_diff($datetime1, $datetime2);
                                                $days = $interval->format('%a ');
                                                $ds = $interval->format('%R%a ');
                                                $class = "";
                                                if($ds <= 5){
                                                    $class = "bg-warning";
                                                }
                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                }
                                                $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;text-align: center'>".$d->deadtime.' <br>'.$days.' кун қолди'."</span> ";


                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>Муддати ўтган</span>";
                                                }elseif($ds <= 5){
                                                    $class = "bg-warning";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун қолди'."</span>";
                                                }else{$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун қолди'."</span>";}
                                                if(\app\models\AppealAnswer::find()->where(['appeal_id'=>$d->appeal_id])->andWhere(['status'=>0])->count('id') > 0){
                                                    $info = "<span class='fa fa-info-circle bg-warning' style='width: 100%; display: block; text-align: center; padding:3px; font-size: 12px;'> Янги жавоб</span>";
                                                    $res = $info . $res;
                                                }
                                                return $res;
                                            },
                                            'format'=>'raw'
                                        ],

                                        'preview',

                                    ],
                                ]); ?>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>