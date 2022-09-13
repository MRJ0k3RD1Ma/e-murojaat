

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
