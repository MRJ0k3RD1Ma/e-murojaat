<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyType */

$this->title = 'Ўзгартириш: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ташкилот турлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="company-type-update">

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
