<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealQuestion */

$this->title = 'Қўшиш Appeal Question';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-create">

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
