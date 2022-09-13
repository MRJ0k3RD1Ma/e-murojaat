<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .register{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        margin-top: 3%;
        padding: 3%;
    }
    .register-left{
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }
    .register-left input{
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }
    .register-right{
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }
    .register-left img{
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite  alternate;
        animation: mover 1s infinite  alternate;
    }
    @-webkit-keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    @keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    .register-left p{
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }
    .register .register-form{
        padding: 10%;
        margin-top: 10%;
    }
    .btnRegister{
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }
    .btnTelegram{
        margin-top: 10%;
        border-radius: 1.5rem;
        padding: 10px 30px;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
    }
    .btnTelegram:hover{
        color: #0062cc;
        background: #fff;
    }
    .register .nav-tabs{
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }
    .register .nav-tabs .nav-link{
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }
    .register .nav-tabs .nav-link:hover{
        border: none;
    }
    .register .nav-tabs .nav-link.active{
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }
    .register-heading{
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
    .login-page{
        height: 100vh !important;
    }
</style>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Хуш келибсиз</h3>
            <p>Тизим бўйича шикоят ва таклифлар учун бизнинг телеграм гуруҳимизга уланинг.</p>
            <a href="https://t.me/joinchat/DyZIXpPeovI5NmVi" class="btnTelegram" target="_blank"><span class="fa fa-paper-plane"></span> Телеграм</a><br/>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">


            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Ўз маълумотларингизни янгиланг</h3>
                    <?php $form = ActiveForm::begin()?>
                    <div class="row register-form">

                        <div class="col-md-6">
                            <?= $form->field($model,'name')->textInput()?>

                            <?= $form->field($model,'phone')->textInput()?>

                            <?= $form->field($model,'username')->textInput()?>

                            <?= $form->field($model,'password')->textInput()?>



                        </div>
                        <div class="col-md-6">

                            <?= $form->field($model,'address')->textInput()?>

                            <?= $form->field($model,'bulim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Bulim::find()->all(),'id','name'))?>

                            <?= $form->field($model,'lavozim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Lavozim::find()->all(),'id','name'))?>

                            <input type="submit" class="btnRegister" value="Сақлаш"/>

                        </div>


                    </div>
                    <?php ActiveForm::end()?>
                </div>

            </div>
        </div>
    </div>

</div>