<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */

$this->title = 'Мурожаатни янгилаш';
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $register->date.' '.$register->number, 'url' => ['view','id'=>$register->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-create">

    <div class="row">
        <div class="col-12">

                    <?= $this->render('_form', [
                    'model' => $model,
                    'register'=>$register,
                    ]) ?>

        </div>
    </div>


</div>
