<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bulim */

$this->title = 'Update Bulim: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bulim-update">

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
