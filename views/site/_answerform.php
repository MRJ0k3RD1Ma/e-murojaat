<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppealAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-answer-form">
    <?php if(false){?>

    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/site/answer','id'=>$model->register_id])]); ?>


    <?= $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'date')->textInput(['type'=>'date']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tarqatma_number')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tarqatma_date')->textInput(['type'=>'date']) ?>

        </div>
    </div>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reaply_send')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Жўнатиш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php }else{?>
        Жавоб юбориш техник сабабларга кўра тўхтатилган.
    <?php }?>
</div>
