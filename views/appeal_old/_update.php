<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Ўзгартириш';
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_name, 'url' => ['view','id'=>$register->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
    <script>
        var deleteitem = function(){};
        var deletetashkilotitem = function(){};
        var tashkilotadd = function(){};
    </script>
    <div class="appeal-form">

        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>


        <div class="row">

            <div class="col-md-12">
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
                                    <div class="col-md-2">
                                        <?= $form->field($register, 'nazorat')->checkbox(['value' => 1,'checked'=>true,'style'=>'margin-top:35px;']) ?>
                                    </div>

                                </div>

                                <?= $form->field($register,'rahbar_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'))?>

                                <?= $form->field($register,'ijrochi_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'))?>

                                <?= $form->field($register, 'preview')->textarea(['maxlength' => true]) ?>


                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>

        <div class="form-group">
            <?= Html::submitButton('Сақлар', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>





    </div>

    <style>
        .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
            width: 100% !important;
        }
    </style>