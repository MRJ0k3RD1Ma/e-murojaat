<?php
use yii\widgets\ActiveForm;
/* @var $model \app\models\Company*/
$form = ActiveForm::begin();
?>
<h4><b><?= $model->name ?></b></h4>
<div class="hidden" hidden>

    <?= $form->field($model,'redirect')->textInput()?>

</div>

<?= $form->field($model,'paid')->checkbox(['value'=>1])?>

<?= $form->field($model,'paid_date')->textInput(['type'=>'date'])?>

<?= $form->field($model,'phone')->textInput()?>

<button class="btn btn-success" type="submit">Saqlash</button>

<?php ActiveForm::end()?>


