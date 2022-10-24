<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceLots */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-lots-form">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'lot_number')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'ads')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'service_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Service::find()->all(),'id','name'),['disabled'=>true]) ?>

                    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['serive_lot_status']) ?>

                    <?= $form->field($model, 'exp_date')->textInput(['type'=>'date']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>