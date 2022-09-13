<?php
$this->title = "Ташкилотга келган мурожаатларни назорат қилиш";
?>
<?php
use app\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;

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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/control/index'])?>">
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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/control/index','type'=>'closed'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Бажарилган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['=','status',2])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id')) ?> та</span>
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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/control/index','type'=>'running'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жараёнда</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','status',2])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id'))?> та</span>
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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/control/index','type'=>'dead'])?>">
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
                                                ->andWhere(['<>','status',2])->andWhere($sql)->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id');
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
                            <div class="card-header">
                                <h3 class="card-title">
                                    Мурожаатлар рўйхати
                                </h3>

                            </div>
                            <div class="card-body">


                                <div class="table-responsive">

                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            [
                                                'label'=>'Рақаси ва санаси',
                                                'value'=>function($d){
                                                    return "<b>№ {$d->number}</b> <br> {$d->date}";
                                                },
                                                'format'=>'raw'
                                            ],
                                            [
                                                'attribute'=>'appeal_id',
                                                'value'=>function($d){
                                                    $q = $d->appeal->question;
                                                    $url = Yii::$app->urlManager->createUrl(['/control/view','id'=>$d->id]);

                                                    $res = $d->appeal->person_name.'<br>'.$q->group->code.'-'.$q->code.'.'.$q->name;
                                                    return "<a href='{$url}'>{$res}</a>";
                                                },
                                                'format'=>'raw',
                                            ],
                                            [
                                                'attribute'=>'rahbar_id',
                                                'value'=>function($d){
                                                    return isset($d->rahbar) ? $d->rahbar->name : '';
                                                }
                                            ],
                                            [
                                                'attribute'=>'ijrochi_id',
                                                'value'=>function($d){
                                                    return isset($d->ijrochi) ? $d->ijrochi->name : '';
                                                }
                                            ],

                                            [
                                                'attribute'=>'control_id',
                                                'value'=>function($d){
                                                    return $d->control->name;
                                                }
                                            ],

                                            [
                                                'attribute'=>'deadtime',
                                                'value'=>function($d){
													if($d->status == 2){
                                                        return "<span class='bg-success' style='width: 100%; height: 100%; display: block;text-align: center'>Бажарилган</span>";
                                                    }
                                                    $ans = isset($d->user_answer) ? json_decode($d->user_answer,true) : [];
                                                    if(is_array($ans) and in_array(Yii::$app->user->id,$ans)){
                                                        return "<span class='bg-success' style='width: 100%; height: 100%; display: block;text-align: center'>Бажарилган</span>";
                                                    }
                                                    $datetime2 = date_create($d->deadtime);
                                                    $datetime1 = date_create(date('Y-m-d'));

                                                    $interval = date_diff($datetime1, $datetime2);
                                                    $days = $interval->format('%a ');
                                                    $ds = $interval->format('%R%a ');
                                                    $class = "";
                                                    if($ds <= 5){
                                                        $class = "bg-warning";
                                                    }
                                                    if($ds < 0){
                                                        $class = "bg-danger";
                                                    }
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;text-align: center'>".$d->deadtime.' <br>'.$days.' кун қолди'."</span> ";

                                                    
													if($ds < 0){
														$class = "bg-danger";
														$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>Муддати ўтган</span>";
													}elseif($ds <= 5){
														$class = "bg-warning";
														$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун қолди'."</span>";
													}else{$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун қолди'."</span>";}
													if(\app\models\AppealAnswer::find()->where(['appeal_id'=>$d->appeal_id])->andWhere(['status'=>0])->count('id') > 0){
                                                        $info = "<span class='fa fa-info-circle bg-warning' style='width: 100%; display: block; text-align: center; padding:3px; font-size: 12px;'> Янги жавоб</span>";
                                                        $res = $info . $res;
                                                    }
                                                    return $res;
                                                },
                                                'format'=>'raw'
                                            ],

                                            'preview',

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