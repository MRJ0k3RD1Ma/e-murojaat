<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\DeadlineChanges */

$this->title = 'Муддат узайтиришга сўров юбориш';
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-create">

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <?php $form = ActiveForm::begin()?>

                    <?= $form->field($model,'comment')->textarea()?>

                    <?= $form->field($model,'file')->fileInput()?>

                    <?= $form->field($model,'deadline')->textInput(['type'=>'date'])?>

                    <button class="btn btn-success" type="submit">Жўнатиш</button>

                    <?php ActiveForm::end()?>
                </div>
            </div>

        </div>
    </div>


</div>
