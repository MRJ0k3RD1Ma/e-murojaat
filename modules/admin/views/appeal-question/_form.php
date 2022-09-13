<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppealQuestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-question-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $res = [];
    foreach (\app\models\AppealQuestionGroup::find()->all() as $item){
        $res[$item->id] = $item->code.'-'.$item->name;
    }
    ?>
    <?= $form->field($model, 'group_id')->dropDownList($res,['prompt'=>'Савол гуруҳини танланг']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
