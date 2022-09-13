<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lavozim */

$this->title = 'Update Lavozim: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lavozim-update">

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
