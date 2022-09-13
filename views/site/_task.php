<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppealBajaruvchi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-answer-form">

    <h4><?= $name?></h4>

    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/site/task','id'=>$id, 'regid'=>$regid])]); ?>

    <?= $form->field($model,'task')->textInput() ?>

    <?= $form->field($model,'deadtime')->textInput(['type'=>'date']) ?>

    <?= $form->field($model,'letter')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Жўнатиш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
