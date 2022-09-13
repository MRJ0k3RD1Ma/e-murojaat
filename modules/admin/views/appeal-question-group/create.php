<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealQuestionGroup */

$this->title = 'Қўшиш Appeal Question Group';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Question Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-group-create">

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
