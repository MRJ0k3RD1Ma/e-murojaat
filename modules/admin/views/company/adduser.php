<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = 'Фойдаланувчи қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Ташкилотлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $company->name, 'url' => ['view','id'=>$company->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_user', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
