<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */
/* @var $ans app\models\AppealAnswer */

$this->title = $model->person_name;
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<script>
    var tashkilotadd = function(){}
</script>
<div class="row">
    <div class="col-md-6">

        <?= $this->render('view/_appeal',['model'=>$model])?>

    </div>
    <div class="col-md-6">

        <?= $this->render('view/_appealer',['model'=>$model])?>

    </div>
</div>





<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-md-<?php if($register->status == 0 or $register->status == 1 or $register->status == 2) echo 12; else echo 6?>">

                <?= $this->render('view/_register',['register'=>$register])?>

            </div>

            <?php if($register->status > 2 and $register->parent_bajaruvchi_id){?>
                <div class="col-md-6">

                    <?= $this->render('view/_sended',['register'=>$register])?>

                </div>
            <?php }elseif($register->status > 2 and !$register->parent_bajaruvchi_id){?>
                <div class="col-md-6">

                    <?= $this->render('view/_close',['model'=>$model])?>

                </div>
            <?php }?>
        </div>

        <hr>
        <div id="accordion">
            <div class="dropdown" style="display: inline-block">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Юклаб олинг
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['/appeal/getappeal','id'=>$register->id])?>" id="downappeal"><span class="fa fa-download"></span> Мурожаат масаласини юклаб олиш</a>
                    <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['/getappeal/print','id'=>$register->id])?>" id="downappeal"><span class="fa fa-download"></span> Назорат карточкани юклаб олиш</a>

                </div>
            </div>
            <?php if($task_emp->status>1){?>

            <?php if($register->status != 3 and $model->status != 4){?>


                    <?= $this->render('view/_buttons',['register'=>$register])?>


            <?php }?>
            <?php }else{?>
                <a class="btn btn-success" href="<?= Yii::$app->urlManager->createUrl(['/site/ok','id'=>$register->id])?>">Мурожаатни қабул қилиш</a>
            <?php }?>

            <?= $this->render('view/_task',['register'=>$register])?>


            <div id="answer" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #28a745;" data-parent="#accordion">
                <?php if($register->status != 4){?>
                    <?php
                    if($register->parent_bajaruvchi_id){
                        echo $this->render('view/_answerformmy',['model'=>$answer]);
                    }else{
                        echo  $this->render('view/_closeformmy',['model'=>$model,'register'=>$register,'answer'=>$answer,]);
                    } ?>
                <?php }else{echo "Мурожаатга жавоб юборилган";}?>
            </div>



        </div>

    </div>


</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Топшириқ юборилган ташкилотлар рўйхати
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th></th>
                        <th>Ташкилот номи</th>
                        <th>Топшириқ матни</th>
                        <th>Илова</th>
                        <th>Юборилган сана</th>
                        <th>Ҳолат</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $n=0; foreach ($register->child as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td>
                                <?php if($item->status==3 and $item->sender_id==Yii::$app->user->id){?>
                                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['/site/showresult','id'=>$item->id])?>"><span class="<?= $item->status0->icon?>"></span></a>
                                <?php }else{?>
                                    <span class="<?= $item->status0->icon?>"></span>
                                <?php }?>
                            </td>

                            <td><?= $item->company->name?></td>
                            <td><?= $item->task?></td>
                            <td><?= $item->letter? "<a href='/upload/{$item->letter}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->status0->name ?></td>
                            <td>
                                <?php if($item->status<2){?>
                                    <a data-method="post" data-confirm="Siz rostdan ham ushbu topshiriqni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/site/deletetask','id'=>$item->id])?>"><span class="fa fa-trash"></span></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Топшириқ юборилган ҳодимлар рўйхати
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th></th>
                        <th>ФИО</th>
                        <th>Топшириқ матни</th>
                        <th>Илова</th>
                        <th>Юборилган сана</th>
                        <th>Юборувчи</th>
                        <th>Ҳолат</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $n=0; foreach ($register->childemp as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?php if($item->status==3){?>
                                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['/appeal/showresult',])?>"><span class="<?= $item->status0->icon?>"></span></a>
                                <?php }else{?>
                                    <span class="<?= $item->status0->icon?>"></span>
                                <?php }?>
                            </td>

                            <td><?= $item->reciever->name ?></td>
                            <td><?= $item->task ?></td>
                            <td><?= $item->letter? "<a href='/upload/{$item->letter}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->sender->name ?></td>
                            <td><?= $item->status0->name ?></td>
                            <td>
                                <?php if($item->status<2){?>
                                    <a data-method="post" data-confirm="Siz rostdan ham ushbu topshiriqni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/appeal/deletetask'])?>"><span class="fa fa-trash"></span></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Bu joyi hali yoziladi-->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Ташкилотлар томонидан келган жавоблар рўйхати
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th></th>
                        <th>Ташкилот номи</th>
                        <th>Рақами</th>
                        <th>Ҳужжат номи	</th>
                        <th>Илова</th>
                        <th>Ижрочи</th>
                        <th>Юборилган сана</th>
                        <th>Ҳолат</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $n=0; foreach ($register->childanswermy as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td>
                                <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['/site/viewresult','id'=>$item->id])?>"><span class="<?= $item->status0->icon?>"></span></a>
                            </td>

                            <td><?= $item->bajaruvchi->company->name?></td>
                            <td><?= $item->number.'<br>'.$item->date ?></td>
                            <td><?= $item->preview?></td>
                            <td><?= $item->file? "<a href='/upload/{$item->file}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->name?></td>
                            <td><?= $item->parent->sender->name.'<br>'.$item->created ?></td>
                            <td><?= $item->status0->name ?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="modaltashkilot" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Топшириқ бериш</h4>
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



<style>
    .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
        width: 100% !important;
    }
</style>


<?php
$url = Yii::$app->urlManager->createUrl(['/site/task','regid'=>$register->id]);
$this->registerJs("
        $(document).ready(function(){
              $('.datatable_tashkilot').DataTable({
                \"processing\": true,
                \"serverSide\": true,

                \"ajax\": {
                    \"url\":\"/get/gettashkilot\",
                    \"type\":\"post\"
                },
                \"columns\": [
                    { \"data\": \"id\" },
                    { \"data\": \"name\" },
                    { \"data\": \"director\" },
                    { \"data\": \"inn\" }
                ],
            });
        })
        
        tashkilotadd = function(id){
            $('#modaltashkilot').modal('show').find('.modal-body').load('{$url}&id='+id);
        }     
        
        $('.datatable_emp').DataTable(); 
        
        $('.taskemp').click(function(){
            var url = this.value;
            $('#modaltashkilot').modal('show').find('.modal-body').load(url);  
        })
        
        
    ")
?>
