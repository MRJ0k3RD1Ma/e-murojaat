<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= Yii::$app->urlManager->createUrl(['/site/index'])?>"><b>E-MUROJAAT.UZ</b> <br>ахборот тизими</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <?php if(isset($message)){?>
                <h3 class="text-danger"><?= $message?></h3>
            <?php }?>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<p class=\"login-box-msg\">{error}</p> <div class=\"input-group mb-3\">{input}<div class=\"input-group-append\">
                        ",
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Логин']) ?>
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Пароль']) ?>
    <div class="input-group-text">
        <span class="fas fa-lock"></span>
    </div>
</div>
    

<div class="row">
    <div class="col-8">
    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "
        <div class=\"icheck-primary\">
    {input} {label}</div><div class=\"col-lg-8\">{error}</div>",
    ])->label('Эслаб қолиш') ?>
    </div>

    <!-- /.col -->
    <div class="col-4">
        <?= Html::submitButton('Кириш', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
    <!-- /.col -->
</div>
            <?php ActiveForm::end(); ?>



