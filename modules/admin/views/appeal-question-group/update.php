<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealQuestionGroup */

$this->title = 'Update Appeal Question Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Question Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-question-group-update">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
