<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */
/* @var $ans app\models\AppealAnswer */

$this->title = $model->person_name;
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-create">


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Муожаат маълумотлари
                    </h3>
                    <div class="card-tools">
                        <?php
                        if($register->status != 2){

                            $datetime2 = date_create($register->deadtime);
                            $datetime1 = date_create(date('Y-m-d'));

                            $interval = date_diff($datetime1, $datetime2);
                            $days = $interval->format('%a ');
                            $ds = $interval->format('%R%a ');
                            $class = "";
                            if($ds < 0){
                                $class = "bg-danger";
                                echo "<span class='{$class}' >Муддати ўтган</span>";
                            }elseif($ds <= 5){
                                $class = "bg-warning";
                                echo "<span class='{$class}' >".$days.' кун қолди'."</span>";
                            }else{echo "<span class='{$class}' >".$days.' кун қолди'."</span>";}

                        }

                        ?>
                        <?php
                            if($register->status != 2){
                                echo "<span class=\"btn btn-warning\"> Жараёнда</span>";
                            }else{
                                echo "<span class=\"btn btn-success\"> Бажарилган</span>";
                            }


                            ?>

                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/update','id'=>$register->id])?>" class="btn btn-primary">Резолюция ёзиш</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">

                            <table class="table table-hover table-bordered">
                                <tbody class="bg-default">
                                <tr>
                                    <th>Мурожаат рақами ва санаси:</th>
                                    <td>
                                        <?php if($register->nazorat == 1 and $model->status != 2) echo "<span class='bg-danger' style='padding:5px;'>Назоратга олинган</span><br>";?>
                                        <b>№ <?= $register->number?></b> <br> <?= $register->date ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Мурожаатчи ФИО</th>
                                    <th>Мурожаат саволи:</th>
                                </tr>
                                <tr>
                                    <td><?= $model->person_name?></td>
                                    <td><?php $q = $model->question;  echo $q->group->code.'-'.$q->code.'.'.$q->name;?></td>
                                </tr>
                                <tr>
                                    <th>Мурожаат иловаси:</th>
                                    <td><?php if($model->appeal_file){?>
                                            <a href="/upload/<?=$model->appeal_file?>" download>Юклаб олинг</a>
                                        <?php }else{?>
                                            Илова мавжуд эмас
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2"><b>Мурожаат матни</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= $model->pursuit == 1 ? '<b>Тақиб ҳақида огоҳлантириш</b> <br>' : ''?>
                                        <?= $model->appeal_detail ?></td>
                                </tr>



                                <?php if($model->boshqa_tashkilot == 1){?>
                                    <tr>
                                        <th>Бошқа Ташкилот:</th>
                                        <td><b>Ташкилот:</b> <?= isset($model->boshqaTashkilot) ? $model->boshqaTashkilot->name : 'Қийматланмаган'?>
                                            <br>
                                            <b>Ташкилот гуруҳи: </b><?= isset($model->boshqaTashkilot->group) ? $model->boshqaTashkilot->group->name : 'Қийматланмаган'?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Хат рақами ва санаси:</th>
                                        <td><?= $model->boshqa_tashkilot_number?> <br> <?= $model->boshqa_tashkilot_date?></td>
                                    </tr>
                                <?php }?>


                                </tbody>
                            </table>
                            <?php if($model->status == 2){?>

                            <table class="table table-hover table-bordered">
                                <tbody class="bg-default">
                                    <tr>
                                        <th>Ижрочи</th>
                                        <td>
                                            <?= $model->answer_name?>
                                            <br>
                                            <b><?php if($model->answer_reply_send == 1)echo "Жавоб хати юборилган"; else echo "Жавоб хати юборилмаган";?></b>
                                            <b>№<?= $model->answer_number?></b>
                                            <b><?= $model->answer_date?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Қисқача мазмуни:</th>
                                        <td><?= $model->answer_preview?></td>
                                    </tr>
                                    <tr>
                                        <th>Жавоб иловаси</th>
                                        <td><?php if($model->answer_file){echo "<a href='/upload/{$model->answer_file}' download='true'>Юклаб олиш</a>";}else{echo "Илова мавжуд эмас";}?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Жавоб матни</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?= $model->answer_detail?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php }?>


                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th>Мурожаатга маъсул раҳбар:</th>
                                    <td><?= isset($register->rahbar) ? $register->rahbar->name : 'Қийматланмаган'?></td>
                                </tr>

                                <tr>
                                    <th>Раҳбар резолюцияси:</th>
                                    <td><?= $register->preview?></td>
                                </tr>
                                <tr>
                                    <th>Муддат:</th>
                                    <td>
                                        <?php

                                        echo "<span style='width: 100%; height: 100%; display: block;'>".$register->deadtime.' санагача <br> Умумий: '.$register->deadline.' кун'."</span>";

                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <div class="cardd card-pridmary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Мурожаатчи маълумотлари</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Мурожаат қўшимча маълумотлари</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-ect-tab" data-toggle="pill" href="#custom-tabs-three-ect" role="tab" aria-controls="custom-tabs-three-ect" aria-selected="false">Бажарувчилар рўйхати</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body" style="border: 1px solid #dee2e6;border-top: 0px;">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>ФИО:</th>
                                                    <td colspan="3"><a href="#">Allabergenov Dilmurod</a> (<?= $model->isbusinessman == 0 ? 'Жисмоний шахс' : 'Юридик шахс'?>)</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Туғилган санаси</b>:</td>
                                                    <td><?= $model->date_of_birth?></td>
                                                    <td><b>Миллати:</b></td>
                                                    <td><?= $model->nation->name?></td>

                                                </tr>
                                                <tr>
                                                    <th>Яшаш манзили:</th>
                                                    <td colspan="3"><?= $model->region->name.' '.$model->district->name.' '.$model->village->name.' '.$model->address?></td>
                                                </tr>
                                                <tr>
                                                    <th>Алоқа маълумотлари:</th>
                                                    <td colspan="3"><b>Тел:</b> <?= $model->person_phone?><br><b>Эл-почта:</b> <?= $model->email?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>Мурожаат шакли:</th>
                                                    <td> <?= $model->appealShakl->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Мурожаат тури:</th>
                                                    <td><?= $model->appealType->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Мурожаат ҳолати:</th>
                                                    <td><?= $model->appealControl->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Мурожаат рақами ва санаси:</th>
                                                    <td><b>№ <?= $register->number?></b> <br> <?= $register->date?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="custom-tabs-three-ect" role="tabpanel" aria-labelledby="custom-tabs-three-ect-tab">
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th colspan="2">Бажарувчилар рўйхати</th>
                                                </tr>

                                                <tr>
                                                    <th>Ҳодимлар:</th>
                                                    <td>
                                                        <?php $baj = isset($register->users) ? json_decode($register->users,true) : [];
                                                        $ans = isset($register->user_answer) ? json_decode($register->user_answer,true) : [];
                                                        if($baj){
                                                        $n=0; foreach ($baj as $u): $n++;
                                                            $t = "Жараёнда";
                                                            if(in_array("{$u}",$ans)){
                                                                $t = "Қабул қилинган";
                                                            }
                                                            ?>
                                                            <?=$n ?>. <?php $urs = \app\models\User::findOne($u); echo $urs->name; ?><br><?= $urs->phone?>
                                                            <br><b>Ҳолат:</b> <?= $t?>

                                                            <hr>
                                                        <?php endforeach; }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Ташкилотлар:</th>
                                                    <td>
                                                        <?php $baj = isset($register->tashkilot) ? json_decode($register->tashkilot,true) : [];
                                                        $ans = isset($register->tashkilot_answer) ? json_decode($register->tashkilot_answer,true) : [];
                                                        if($baj){
                                                        $n=0; foreach ($baj as $u): $n++;
                                                            $t = "Жараёнда";
                                                            if(in_array("{$u}",$ans)){
                                                                $t = "Қабул қилинган";
                                                            }
                                                            ?>
                                                            <?=$n ?>. <?php $urs = \app\models\Company::findOne($u); echo $urs->name; ?><br><?= $urs->phone?>
                                                            <br><b>Ҳолат:</b> <?= $t?>
                                                            <hr>
                                                        <?php endforeach; }?>
                                                    </td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Топшириқга жавоб юбориш
                    </h3>
                </div>
                <div class="card-body">

                    <?php $us = json_decode($register->users,true); ?>
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th colspan="2">Мурожаатга маъсул ҳодим:</th>
                                <td colspan="2">
                                    <?= isset($register->ijrochi)?$register->ijrochi->name : 'Қийматланмаган'?>
                                    <br> <?= isset($register->ijrochi)? $register->ijrochi->phone : '';?>
                                </td>
                            </tr>
                            </thead>

                            <tbody>

                                <?= $this->render('_rahbar',['model'=>$model,'register'=>$register])?>
                                <?= $this->render('_ijrochi',['model'=>$model,'register'=>$register])?>
                                <?= $this->render('_mening',['model'=>$model,'register'=>$register, 'answer'=>$answer,]) ?>

                            </tbody>



                        </table>

                    </div>
                </div>
            </div>



        </div>
    </div>


</div>

    <!-- Modal -->
    <div id="myfiles" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Юборилган жавоб</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>


<?php

$this->registerJs("
    $('.myfiles').click(function(){
        var url = this.value;
        $('#myfiles').modal('show').find('.modal-body').load(url);
    })
")
?>