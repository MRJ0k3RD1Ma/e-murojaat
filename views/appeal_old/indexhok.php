<?php

$this->title = 'Мурожаатлар рўйхати';
?>
<?php

use app\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$user = Yii::$app->user->identity;
?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">


            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жами топшириқлар</h5>
                                        <br />
                                        <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>\Yii::$app->user->identity->company_id])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id')) ?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/web/theme/dist/img/home.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px; height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'closed'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Бажарилган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['=','status',4])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id')) ?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/web/theme/dist/img/home_human.png" style="color: #397fd5;font-size: 85px;float: right; height: 50px; position: absolute;right: 20px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'running'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жараёнда</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','status',4])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id'))?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/web/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'dead'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Муддати ўтган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?php
                                            $sql = "deadtime<date(now())";
                                            $query = AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','status',4])->andWhere($sql)->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id');
                                            echo prettyNumber($query)?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/web/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">


                            <div class="table-responsive">

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'label'=>'Рақами ва санаси',
                                            'value'=>function($d){
                                                $d->created = date('d-m-Y',strtotime($d->created));
                                                $url = Yii::$app->urlManager->createUrl(['/appeal/viewhok','id'=>$d->id]);
                                                return "<a href='{$url}'><b>№ {$d->number_full}</b> <br> {$d->created}</a>";
                                            },
                                            'format'=>'raw'
                                        ],
                                        'person_name',
                                        'person_phone',
//                                        'address',
                                        [
                                            'attribute'=>'address',
                                            'value'=>function($d){
                                                return $d->district->name.' '.$d->village->name.' '.$d->address;
                                            }
                                        ],
                                        'appeal_detail',
                                        [
                                            'attribute'=>'deadtime',
                                            'value'=>function($d){

                                                if($d->status == 4){
                                                    return "<span class='bg-success' style='display: block;text-align: center'>Бажарилган</span>".
                                                        $d->donetime;
                                                }
                                                $datetime2 = date_create($d->deadtime);
                                                $datetime1 = date_create(date('Y-m-d'));
                                                $interval = date_diff($datetime1, $datetime2);
                                                $days = $interval->format('%a ');
                                                $ds = $interval->format('%R%a ');
                                                $d->deadtime = date('d-m-Y',strtotime($d->deadtime));
                                                $class = "";
                                                if($ds <= 5){
                                                    $class = "bg-warning";
                                                }
                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                }
                                                $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;text-align: center'>".$days.' кун<br>'.$d->deadtime."</span> ";


                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>Муддати ўтган</span>";
                                                }elseif($ds <= 5){
                                                    $class = "bg-warning";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";
                                                }else{$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";}

                                                return $res;
                                            },
                                            'format'=>'raw'
                                        ],

                                    ],
                                ]); ?>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table th,table td{
        min-width: 100px;
    }
</style>