<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealQuestion */

$this->title = 'Update Appeal Question: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-question-update">

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
