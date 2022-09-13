<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $form yii\widgets\ActiveForm */
?>
    <script>
        var deleteitem = function(){};
        var deletetashkilotitem = function(){};
        var tashkilotadd = function(){};
    </script>
<div class="appeal-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Янги мурожаат қўшиш
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($register, 'number')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($register, 'date')->textInput(['type' => 'date']) ?>
                </div>
                <div class="col-md-6">
                    <?php
                    $quest = [];
                    foreach (\app\models\AppealQuestionGroup::find()->all() as $item) {
                        $quest[$item->code.'-'.$item->name] = [];
                        foreach ($item->question as $i){
                            $quest[$item->code.'-'.$item->name][$i->id] = $item->code.' '.$i->code.')'.$i->name;
                        }
                    }
                    ?>

                    <?= $form->field($model, 'question_id')->dropDownList($quest,['prompt'=>'Саволни танланг','class'=>'form-control js-select2']) ?>

                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Умумий маълумотлар
                    </h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date']) ?>
                    <?= $form->field($model, 'gender')->dropDownList([0=>'Аёл',1=>'Эркак'],['prompt'=>'Жинсини танланг']) ?>
                    <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Манзил
                    </h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name'),['prompt'=>'Вилоятни танланг']) ?>
                    <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\District::find()->where(['region_id'=>$model->region_id])->all(),'id','name'),['prompt'=>'Туманни танланг']) ?>
                    <?= $form->field($model, 'village_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Village::find()->where(['district_id'=>$model->district_id])->all(),'id','name'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2']) ?>
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Бошқа ташкилотдан
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot')->checkbox(['value'=>1,'style'=>'margin-top:35px;'])?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot_number')->textInput()?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot_date')->textInput(['type'=>'date'])?>
                </div>
                <?php   $tashkilot = [];
                foreach (\app\models\AppealBoshqaTashkilotGroup::find()->all() as $item) {
                    $tashkilot[$item->name] = [];
                    foreach ($item->tashkilotlar as $i){
                        $tashkilot[$item->name][$i->id] = $i->name;
                    }
                }
                ?>
                <div class="col-md-3">
                    <?= $form->field($model, 'boshqa_tashkilot_id')->dropDownList($tashkilot,['prompt'=>'Ташкилот гуруҳини танланг танланг','class'=>'form-control js-select2newdata']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

    <div class="row">
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
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Резолюция
                            </h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($register, 'nazorat')->checkbox(['value' => 1,'checked'=>true]) ?>
                                </div>

                            </div>

                            <?= $form->field($register,'rahbar_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'),['prompt'=>'Раҳбарни танланг'])?>

                            <?= $form->field($register, 'preview')->textarea(['maxlength' => true]) ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($register,'deadline')->textInput(['type'=>'number'])?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($register,'deadtime')->textInput(['type'=>'date'])?>
                                </div>
                            </div>

                            <?= $form->field($register,'ijrochi_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all(),'id','name'),['prompt'=>'Ижрочини танланг'])?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Такрорий мурожаат маълумотлари
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <?= $form->field($register, 'takroriy')->checkbox(['value' => 1,'style'=>'margin-top:35px;']) ?>

                                </div>
                                <div class="col-md-5">

                                    <?= $form->field($register, 'takroriy_number')->textInput(['maxlength' => true,'disabled'=>true]) ?>
                                </div>
                                <div class="col-md-5">
                                    <?= $form->field($register, 'takroriy_date')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="display: none" id="users">

    </div>
    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <!-- Modal -->
    <div id="modalhodim" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ҳодимлар рўйхати</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ФИО</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $users = \app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all();


                                foreach ($users as $item):


                            ?>
                                <tr>
                                    <td><button type="button" value="<?= $item->id?>" class="btn btn-success buttonhodimadd btnid-<?=$item->id?>"><span class="fa fa-plus"></span></button></td>
                                    <td class="trhodimadd<?= $item->id?>"><?= $item->name ?></td>
                                </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="modaltashkilot" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ташкилотлар рўйхати</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered datatable_tashkilot">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Ташкилот номи</th>
                            <th>Директор</th>
                            <th>СТИР(ИНН)</th>
                        </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>


</div>

    <style>
        .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
            width: 100% !important;
        }
    </style>
<?php
$js = <<<JS

JS;

$this->registerJs('
     $(document).ready(function() {

            $(\'.datatable_tashkilot\').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url":"/get/gettashkilot",
                    "type":"post"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "director" },
                    { "data": "inn" }
                ],
            });


        $(".js-select2newdata").select2({
                escapeMarkup: function (markup) { return markup; },

         language: {
            "noResults": function() {
              return \'<a id="newData" href="#" class="btn btn-xs btn-success">Янги ташкилот қўшиш</a>\';
            }
          },
        });
    });
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

$("#buttonhodim").click(function(){
    $("#modalhodim").modal();
});

$("#buttontashkilot").click(function(){
    $("#modaltashkilot").modal();
});

$(".buttonhodimadd").click(function(){
    var id=this.value;
    var res = "<tr id=\"u"+id+"\"><td><button value=\"" + id + "\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteitem(\'"+id+"\')\"><span class=\"fa fa-trash\"></span></button></td><td>"+$(".trhodimadd"+id).text()+"</td></tr>"
    $("#tablehomditashkilot").append(res);
    this.disabled = true;
    $("#users").append("<input type=\"text\" id=\"userid-"+id+"\" name=\"AppealRegister[users][]\" value=\""+id+"\">");
    $("#appealregister-ijrochi_id").append("<option value=\""+id+"\">"+$(".trhodimadd"+id).text()+"</option>");
});

$(".buttontashkilotadd").click(function(){
    var id = this.value;
});
tashkilotadd = function(id){
    if($("#tashkilotid-"+id).length ){
        console.log(1);
    }else{
        var res = "<tr id=\"t"+id+"\"><td><button value=\"" + id + "\" type=\"button\" class=\"btn btn-danger\" onclick=\"deletetashkilotitem(\'"+id+"\')\"><span class=\"fa fa-trash\"></span></button></td><td>"+$(".trtashkilotlist"+id).text()+"</td></tr>"
        $("#tablehomditashkilot").append(res);
        this.disabled = true;
        $("#users").append("<input type=\"text\" id=\"tashkilotid-"+id+"\" name=\"AppealRegister[tashkilot][]\" value=\""+id+"\">");
    }
    
}


deleteitem = function(id){
    $("#u"+id).remove();
    $("#userid-"+id).remove();
    $(".btnid-"+id).attr("disabled",false);
    $("#appealregister-ijrochi_id option[value=\""+id+"\"]").remove();
}
deletetashkilotitem = function(id){
    $("#t"+id).remove();
    $("#tashkilotid-"+id).remove();
}
$(".deluser").click(function(){
    var id = this.value;
    alert(id);
    $("#u"+id).remove();
})


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