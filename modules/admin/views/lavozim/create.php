<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lavozim */

$this->title = 'Қўшиш Lavozim';
$this->params['breadcrumbs'][] = ['label' => 'Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lavozim-create">

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
