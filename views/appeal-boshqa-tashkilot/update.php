<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealBoshqaTashkilot */

$this->title = 'Update Appeal Boshqa Tashkilot: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-boshqa-tashkilot-update">

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
