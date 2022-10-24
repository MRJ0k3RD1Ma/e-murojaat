<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = 'Xizmat qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Xizmatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">
    <div class="row">
        <div class="col-md-12">
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
