<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model,'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CompanyGroup::find()->all(),'id','name'),['prompt'=>'Ташкилот гуруҳини танланг'])?>
            <?= $form->field($model,'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CompanyType::find()->where(['group_id'=>$model->group_id])->all(),'id','name'),['prompt'=>'Ташкилот турини танланг'])?>

            <?= $form->field($model, 'management')->checkbox(['value'=>1]) ?>

        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name'),['prompt'=>'Туманни танланг']) ?>

            <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\District::find()->where(['region_id'=>$model->region_id])->all(),'id','name'),['prompt'=>'Туманни танланг']) ?>

            <?= $form->field($model, 'village_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Village::find()->where(['district_id'=>$model->district_id])->all(),'id','name'),['prompt'=>'Маҳаллани танланг']) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'active_to')->textInput(['type'=>'date']) ?>

            <?= $form->field($model, 'active_each')->textInput(['type'=>'date']) ?>

            <?= $form->field($model, 'status')->dropDownList(['1'=>'Актив',0=>'Деактив']) ?>

            <?= $form->field($model, 'token')->textInput() ?>

        </div>
    </div>

    <?php if($model->isNewRecord){?>
    <div class="row">
        <div class="col-md-12">
            <h3 class="card-title">
                Фойдаланувчи маълумотлари
            </h3>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">


            <?= $form->field($user, 'role_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Role::find()->all(),'id','name')) ?>



            <?= $form->field($user, 'bulim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Bulim::find()->all(),'id','name')) ?>

            <?= $form->field($user, 'lavozim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Lavozim::find()->all(),'id','name')) ?>

            <?= $form->field($user, 'is_rahbar')->checkbox() ?>

            <?= $form->field($user, 'is_registration')->checkbox() ?>

            <?= $form->field($user, 'is_resolution')->checkbox() ?>

            <?= $form->field($user, 'is_control')->checkbox() ?>

            <?= $form->field($user, 'is_control_district')->checkbox() ?>

            <?= $form->field($user, 'is_control_system')->checkbox() ?>
        </div>
    </div>



<?php }?>



    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$district = Yii::$app->urlManager->createUrl(['/get/district']);
$village  = Yii::$app->urlManager->createUrl(['/get/village' ]);
$type  = Yii::$app->urlManager->createUrl(['/get/company-type' ]);
$check = Yii::$app->urlManager->createUrl(['/admin/company/check']);
$this->registerJs("
    $('#company-region_id').change(function(){
        $.get('{$district}?id='+$('#company-region_id').val()).done(function(data){
            $('#company-district_id').empty();
            $('#company-district_id').append(data);
        })
    });
    $('#company-district_id').change(function(){
        $.get('{$village}?id='+$('#company-district_id').val()).done(function(data){
            $('#company-village_id').empty();
            $('#company-village_id').append(data);
        })
    })
     $('#company-group_id').change(function(){
        $.get('{$type}?id='+$('#company-group_id').val()).done(function(data){
            $('#company-type_id').empty();
            $('#company-type_id').append(data);
        })
    })
    $('#company-inn').change(function(){
        $.get('{$check}?inn='+$('#company-inn').val()).done(function(data){
            if(data==1){
                Swal.fire(
                  'Inn mavjud',
                  'You clicked the button!',
                  'error'
                )
            }else{
             Swal.fire(
                  'Davom eting',
                  'You clicked the button!',
                  'success'
                )
            }
        })
    })
    
    $('#company-director').change(function(){
        $('#user-name').val($('#company-director').val());
    })
    ");

?>