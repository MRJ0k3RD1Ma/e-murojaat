<?php

use yii\widgets\ActiveForm;

$this->title ="Tizimga kirish";
/* @var $model \app\models\LoginForm */
?>

<div class="login-page">
    <div class="login">
        <div class="logos">
            <div class="img">
                <img src="/gerb-144.png" alt="img" style="float: right; width: 50px;"
                     class="img-responsive">
            </div>
            <div class="text">
                <b>E-MUROJAAT.UZ</b> автоматлаштирилган мурожаатлар мониторинги ахборот тизими
            </div>
        </div>
        <div class="login-form">
            <h3>Тизимга кириш</h3>
            <p>e-murojaat.uz ахборот тизимига хуш келибсиз!</p>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "{input}",
                ],
            ]); ?>
            <div class="form">
                <div class="input">
                    <span class="far fa-user"></span>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => '', 'placeholder' => 'Login']) ?>

                </div>
                <div class="input">
                    <span class="fas fa-lock"></span>
                    <?= $form->field($model, 'password')->passwordInput(['class' => '', 'placeholder' =>'Parol']) ?>
                </div>


                <div class="sign row">
                    <div class="col-md-6">
                        <button class="btn btn-success btn-block">Кириш</button>
                    </div>
                </div>


            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="logos">
            <div class="img">
                <img src="/rir300.png" alt="img" style="float: right; width: 50px;"
                     class="img-responsive">
            </div>
            <div class="text">Ахборот тизими <a href="http://raqamli.uz" style="color: #073cff">"Рақамли иқтисодиётни ривожлантириш"</a> маркази томонидан яратилган</div>

        </div>

        <div class="bottom">
            <a href="https://t.me/+DyZIXpPeovI5NmVi"><span class="fa fa-paper-plane fa-sm"></span> Telegram</a>
            <a href="tel:+998622231878"><span class="fa fa-phone-alt fa-sm"></span> +998622231878</a>
            <a href="tel:+998787704037"><span class="fa fa-phone-alt fa-sm"></span> +998787704037</a>

        </div>

    </div>


</div>




<style>
    .bottom{
        text-align: center;

    }
    .bottom a{
        padding:0 5px;
        color: #073cff;
    }
    .sign {
        display: flex;
        justify-content: flex-end;
    }

    .sign button {
        text-transform: capitalize;
    }

    .sign div {
        display: inline-block;
    }

    .login-form .form {
        width: 100%;
    }

    .login-form .form .input {
        width: 100%;
        position: relative;

    }

    .logos .text {
        font-size: 18px;
        color: black;
    }

    .login-form .form .input input {
        padding-left: 50px;
        font-size: .96rem;
        font-weight: 400;
        line-height: 1.25;
        color: #4e5154;
        background-color: transparent !important;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 5px

    }

    .login-form .form .input input:focus {
        outline: none;
    }

    .login-form .form .input span {
        top: 50%;
        transform: translate(-50%, -50%);
        left: 30px;
        position: absolute;
        font-size: 20px;

    }

    .login-page {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        height: 100vh;
        background: #cfd2e1;
        justify-content: center;
        /*background: url("/theme/dist/img/menu_bg.png") no-repeat;*/
        background-size: cover;
    }

    .login {
        margin-top: 100px;
        width: 700px;

    }

    .logos {
        display: flex;
        align-items: center;
        margin-bottom: 50px;

    }

    .logos .img {
        width: 100px;
        margin-right: 20px;
    }

    .logos .img img {
        width: 100px !important;
        object-fit: cover;
    }

    .login-form {
        margin-bottom: 50px;
        padding: 20px;
        background: #fff;
        text-align: center;
    }

</style>