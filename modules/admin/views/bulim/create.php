<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bulim */

$this->title = 'Қўшиш Bulim';
$this->params['breadcrumbs'][] = ['label' => 'Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulim-create">

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
