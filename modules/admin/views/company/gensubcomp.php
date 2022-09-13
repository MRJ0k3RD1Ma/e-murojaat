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

                <?= $form->field($model,'region')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name'))?>

                <?= $form->field($model,'district')->dropDownList([])?>
                <?= $form->field($model,'cnt')->textInput()?>

                <button class="btn btn-success">
                    Сақлаш
                </button>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

<?php
$district = Yii::$app->urlManager->createUrl(['/get/district']);
$this->registerJs("
    $('#compmodel-region').change(function(){
        $.get('{$district}?id='+$('#compmodel-region').val()).done(function(data){
            $('#compmodel-district').empty();
            $('#compmodel-district').append(data);
        })
    });
    ");

?>