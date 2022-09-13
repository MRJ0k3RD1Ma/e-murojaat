<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'role_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Role::find()->all(),'id','name')) ?>



            <?= $form->field($model, 'bulim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Bulim::find()->all(),'id','name')) ?>

            <?= $form->field($model, 'lavozim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Lavozim::find()->all(),'id','name')) ?>

            <?= $form->field($model, 'is_rahbar')->checkbox() ?>

            <?= $form->field($model, 'is_registration')->checkbox() ?>

            <?= $form->field($model, 'is_resolution')->checkbox() ?>

            <?= $form->field($model, 'is_control')->checkbox() ?>

            <?= $form->field($model, 'is_control_district')->checkbox() ?>

            <?= $form->field($model, 'is_control_system')->checkbox() ?>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
