<?php

use yii\helpers\Html;

/* @var $name string*/
/* @var $users \app\models\User*/
/* @var $report array*/
/* @var $jami array*/
$this->title = 'Ҳисоботлар шакллантириш';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <ul class="pagination">
                        <li class="active"><a href="#" data-page="0">1</a></li>
                        <li><a href="#" data-page="1">2</a></li>
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
                <div class="table-responsive">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2">№</th>
                                <th rowspan="2">Ҳоким ва ўринбосарлар</th>
                                <th rowspan="2">Жами мурожаатлар</th>
                                <th colspan="<?= \app\models\AppealShakl::find()->count()?>">Мурожаатларни шакллари</th>
                            </tr>
                            <tr>
                                <?php foreach (\app\models\AppealShakl::find()->all() as $item):?>
                                    <th><?= $item->name?></th>
                                <?php endforeach;?>
                            </tr>
                            <tr>
                                <?php
                                $n = 3 +  \app\models\AppealShakl::find()->count();
                                for($i=1; $i<=$n; $i++):?>
                                <th><?= $i?></th>
                                <?php endfor ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n=0; foreach ($users as $item): $n++?>
                            <tr>
                                <td><?= $n?></td>
                                <td><?= '<b>'.$item->name.'</b>-'.$item->bulim->name.' '.$item->lavozim->name?></td>

                                <?php foreach ($report[$item->id] as $i):?>
                                <td><?= $i ?></td>
                                <?php endforeach;?>
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td></td>
                                <td><b>Жами</b></td>

                                <?php foreach ($jami as $i):?>
                                    <td><b><?= $i ?></b></td>
                                <?php endforeach;?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>