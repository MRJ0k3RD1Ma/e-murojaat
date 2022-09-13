<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $form yii\widgets\ActiveForm */
?>
   <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Мурожаатчи маълумотлари
                        </h3>
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-md-6">

                                <?= $form->field($model, 'passport')->textInput() ?>
                                <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'passport_jshshir')->textInput() ?>

                                <?= $form->field($model, 'gender')->dropDownList([0=>'Аёл',1=>'Эркак'],['prompt'=>'Жинсини танланг']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name'),['prompt'=>'Вилоятни танланг']) ?>
                        <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\District::find()->where(['region_id'=>$model->region_id])->all(),'id','name'),['prompt'=>'Туманни танланг']) ?>
                        <?= $form->field($model, 'village_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Village::find()->where(['district_id'=>$model->district_id])->all(),'id','name'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2']) ?>

                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Мурожаат матни
                        </h3>
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'appeal_shakl_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AppealShakl::find()->all(),'id','name'),['prompt'=>'Мурожаат шаклини танланг']) ?>

                        <?= $form->field($model, 'appeal_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AppealType::find()->all(),'id','name'),['prompt'=>'Мурожаат турини танланг']) ?>

                        <?= $form->field($model, 'isbusinessman')->checkbox(['value' => 1,'style'=>'margin-top:20px;']) ?>

                        <?= $form->field($model, 'businessman',['options'=>['style'=>'display:none']])->textInput() ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'count_applicant')->textInput(['type'=>'number']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'count_list')->textInput(['type'=>'number']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'pursuit')->checkbox(['value' => 1,'style'=>'margin-top:20px;']) ?>

                        <?= $form->field($model, 'appeal_detail')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'appeal_file')->fileInput(['maxlength' => true]) ?>
                    </div>
                </div>

            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>





    <style>
        .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
            width: 100% !important;
        }
    </style>
<?php
$js = <<<JS

JS;

$this->registerJs('
   
    $(document).on(\'click\', \'#newData\', function() {
      var $select2 = $(".js-select2newdata");      
      var newStateVal = $select2.siblings("span.select2-container").find("input.select2-search__field").val();
      //Get the new value.
      if ($select2.find("option[value=" + newStateVal + "]").length) { //if already present just select it
          $select2.val(newStateVal).trigger("change");
      } else {
          // Create the DOM option that is pre-selected by default
          var newState = new Option(newStateVal, newStateVal, true, true);
          // Append it to the select
          $select2.append(newState).trigger(\'change\');
          $select2.select2(\'close\');
      }
});

$("#appeal-isbusinessman").change(function(){
    if($("#appeal-isbusinessman").is(":checked")){
        $(".field-appeal-businessman").show();
    }else{
        $(".field-appeal-businessman").hide();
    }
})
$("#appealregister-deadline").change(function(){
    
    var today = new Date($("#appealregister-date").val());
    var res = new Date();
//    res.setDate( today.getDate() + $("#appealregister-deadline").val() );
    var day= new Date(today.getFullYear(),today.getMonth(), today.getDate() + parseInt($("#appealregister-deadline").val()) );
//    alert(day);
    res = day;
//    alert(res);
    $("#appealregister-deadtime").val(res.getFullYear()+"-"+("0"+(res.getMonth()+1)).slice(-2)+"-"+("0"+res.getDate()).slice(-2));
    
});
$("#appealregister-date").change(function(){
    
    var today = new Date($("#appealregister-date").val());
    var res = new Date();
//    res.setDate( today.getDate() + $("#appealregister-deadline").val() );
    var day= new Date(today.getFullYear(),today.getMonth(), today.getDate() + parseInt($("#appealregister-deadline").val()) );
//    alert(day);
    res = day;
//    alert(res);
    $("#appealregister-deadtime").val(res.getFullYear()+"-"+("0"+(res.getMonth()+1)).slice(-2)+"-"+("0"+res.getDate()).slice(-2));
    
});


');
$this->registerJs("
    $('#appeal-region_id').change(function(){
        $.get('/get/district?id='+$('#appeal-region_id').val()).done(function(data){
            $('#appeal-district_id').empty();
            $('#appeal-district_id').append(data);
        })
    });
    $('#appeal-district_id').change(function(){
        $.get('/get/village?id='+$('#appeal-district_id').val()).done(function(data){
            $('#appeal-village_id').empty();
            $('#appeal-village_id').append(data).trigger('change');
        })
    })
")
?>