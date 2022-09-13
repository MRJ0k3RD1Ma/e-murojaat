<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppealBoshqaTashkilot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-boshqa-tashkilot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'autofocus'=>true]) ?>

    <?= $form->field($model, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AppealBoshqaTashkilotGroup::find()->all(),'id','name'),['prompt'=>'Ташкилот гуруҳини танланг']) ?>


    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
