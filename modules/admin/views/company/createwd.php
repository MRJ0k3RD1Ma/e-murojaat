<?php
use yii\widgets\ActiveForm;

/* @var $model \app\models\CompModel*/
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin()?>
                <?= $form->field($model,'name')->textInput()?>

                <?= $form->field($model,'username')->textInput()?>

                <?= $form->field($model,'password')->textInput()?>
                <button class="btn btn-success">
                    Сақлаш
                </button>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>
