<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealBoshqaTashkilot */

$this->title = 'Қўшиш Appeal Boshqa Tashkilot';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-boshqa-tashkilot-create">

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
