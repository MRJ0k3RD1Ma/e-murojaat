<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Маълумотларни янгилаш';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin()?>
                <div class="row register-form">

                    <div class="col-md-6">
                        <?= $form->field($model,'name')->textInput()?>

                        <?= $form->field($model,'phone')->textInput()?>

                        <?= $form->field($model,'username')->textInput()?>

                        <?= $form->field($model,'password')->textInput()?>



                    </div>
                    <div class="col-md-6">

                        <?= $form->field($model,'address')->textInput()?>

                        <?= $form->field($model,'bulim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Bulim::find()->all(),'id','name'))?>

                        <?= $form->field($model,'lavozim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Lavozim::find()->all(),'id','name'))?>

                        <input type="submit" class="btn btn-success" style="margin-top:30px;" value="Сақлаш"/>
                    </div>


                </div>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>
