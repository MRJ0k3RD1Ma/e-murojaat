<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = 'Ташкилот қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Ташкилотлар   ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'user'=>$user
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
