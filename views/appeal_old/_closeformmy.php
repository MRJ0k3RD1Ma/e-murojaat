<?php

use app\models\AppealControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppealAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-answer-form">

    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/appeal/closemy','id'=>$register->id])]); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'answer_number')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'answer_date')->textInput(['type'=>'date']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'appeal_control_id')->dropDownList(ArrayHelper::map(AppealControl::find()->where(['>','id',1])->all(),'id','name'),
                ['prompt'=>'Назоратдан олиш']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'answer_preview')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'answer_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_file')->fileInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'answer_reply_send')->checkbox(['value'=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
