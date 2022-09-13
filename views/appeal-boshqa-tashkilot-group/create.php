<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealBoshqaTashkilotGroup */

$this->title = 'Ташкилот гуруҳи қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Ташкилот гуруҳлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-boshqa-tashkilot-group-create">

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
