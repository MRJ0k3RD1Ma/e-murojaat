<?php

use yii\helpers\Html;

/* @var $name string*/
/* @var $users \app\models\User*/
/* @var $report array*/
/* @var $jami array*/
/* @var $date string*/
/* @var $group \app\models\AppealQuestionGroup*/
/* @var $shakl \app\models\AppealShakl*/
/* @var $control \app\models\AppealControl*/
$this->title = 'Ҳисоботлар шакллантириш';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <ul class="pagination">
                        <li><a href="#" data-page="0">1</a></li>
                        <li class="active"><a href="#" data-page="1">2</a></li>
                        <li><a href="#" data-page="2">3</a></li>
                        <li><a href="#" data-page="3">4</a></li>
                        <li><a href="#" data-page="4">5</a></li>
                        <li><a href="#" data-page="5">6</a></li>
                        <li><a href="#" data-page="6">7</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <p><?= $name?></p>
                <div class="table-responsive tableFixHead">

                    <table class="table table-bordered table-hover" id="datatable1">
                        <thead>
                        <tr>
                            <th rowspan="3">№</th>
                            <th rowspan="3">Мурожаатларда кўтарилан масалалар</th>
                            <th rowspan="3">Жами мурожаатлар сони</th>
                            <th colspan="<?= 3+\app\models\AppealShakl::find()->count()+\app\models\AppealControl::find()->count()?>">Шу жумладан</th>
                        </tr>
                        <tr>
                            <th colspan="<?= \app\models\AppealShakl::find()->count() ?>">Мурожаатларни шакллари</th>
                            <th colspan="<?= \app\models\AppealControl::find()->count()+3?>"><?= $date?> йил бўйича мурожаатларни кўриб чиқиш ҳолатлари</th>
                        </tr>
                        <tr>
                            <?php foreach (\app\models\AppealShakl::find()->all() as $item):?>
                                <th><?= $item->name?></th>
                            <?php endforeach;?>
                            <th>Назоратга олинганлар</th>
                            <?php foreach (\app\models\AppealControl::find()->all() as $item):?>
                                <th><?= $item->name?></th>
                            <?php endforeach;?>
                            <th class="vertical-text">такрорийлар</th>
                            <th class="vertical-text">муддати бузилганлар</th>
                        </tr>
                        <tr>
                            <?php for($i=1; $i<=6+\app\models\AppealShakl::find()->count()+\app\models\AppealControl::find()->count(); $i++):?>
                                <th><?= $i?></th>
                            <?php endfor?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $n=0; foreach ($group as $item):$n++?>
                                <tr>
                                    <th><?= $n?></th>
                                    <th><?= $item->name?></th>

                                    <td><?= $report[$item->id][0][0]?></td>

                                    <?php foreach ($shakl as $i):?>
                                    <td><?= $report[$item->id][$i->id][1]?></td>
                                    <?php endforeach;?>

                                    <td><?= $report[$item->id][3][0]?></td>

                                    <?php foreach ($control as $i):?>
                                        <td><?= $report[$item->id][$i->id][2]?></td>
                                    <?php endforeach;?>

                                    <td><?= $report[$item->id][4][0]?></td>

                                    <td><?= $report[$item->id][5][0]?></td>

                                </tr>
                            <?php endforeach;?>
                            <tr>
                                <th></th>
                                <th>Жами</th>
                                <td><?= $jami[0][0]?></td>

                                <?php foreach ($shakl as $i):?>
                                    <td><?= $jami[1][$i->id]?></td>
                                <?php endforeach;?>

                                <td><?= $jami[3][0]?></td>

                                <?php foreach ($control as $i):?>
                                    <td><?= $jami[2][$i->id]?></td>
                                <?php endforeach;?>

                                <td><?= $jami[4][0]?></td>

                                <td><?= $jami[5][0]?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    th {
        background: white;
        position: sticky;
        top: 0; /* Don't forget this, required for the stickiness */
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
    }
</style>
