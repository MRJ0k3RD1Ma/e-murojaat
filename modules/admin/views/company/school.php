<?php
use yii\widgets\ActiveForm;

/* @var $model \app\models\SchoolModel*/
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

                    <?= $form->field($model,'count')->textInput()?>

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
    $('#schoolmodel-region').change(function(){
        $.get('{$district}?id='+$('#schoolmodel-region').val()).done(function(data){
            $('#schoolmodel-district').empty();
            $('#schoolmodel-district').append(data);
        })
    });
    ");

?>