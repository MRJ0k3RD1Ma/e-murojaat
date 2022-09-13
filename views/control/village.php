
<?php
use app\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $district \app\models\District */
/* @var $model \app\models\Village */
/* @var $res Array */
$this->title = $district->name." маҳаллалари кесимида мурожаатлар ҳолати";

?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">


            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Жами топшириқлар</h5>
                                    <br />
                                    <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber($res[0][0]) ?> та</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape">
                                        <img src="/web/theme/dist/img/home.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px; height: 50px;" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Бажарилган</h5>
                                    <br />
                                    <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber($res[0][1]) ?> та</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape">
                                        <img src="/web/theme/dist/img/home_human.png" style="color: #397fd5;font-size: 85px;float: right; height: 50px; position: absolute;right: 20px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Жараёнда</h5>
                                    <br />
                                    <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber($res[0][2])?> та</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape">
                                        <img src="/web/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Муддати ўтган</h5>
                                    <br />
                                    <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?php

                                        echo prettyNumber($res[0][3])?> та</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape">
                                        <img src="/web/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Маҳаллалар рўйхати
                            </h3>

                        </div>
                        <div class="card-body">


                            <div class="table-responsive">


                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Номи</th>
                                        <th>Жами</th>
                                        <th>Бажарилган</th>
                                        <th>Жараёнда</th>
                                        <th>Муддати ўтган</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n=0; foreach ($model as $item): $n++;?>
                                            <tr>
                                                <td><?= $n;?></td>
                                                <td><?= $item->name?></td>
                                                <td class="text-center"><?= $res[$item->id][0]?></td>
                                                <td class="text-center"><?= $res[$item->id][1]?></td>
                                                <td class="text-center"><?= $res[$item->id][2]?></td>
                                                <td class="text-center"><?= $res[$item->id][3]?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>