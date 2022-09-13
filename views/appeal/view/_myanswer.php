
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Менинг жавобларим
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
                    <?php $n=0; foreach ($register->answer as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?php if($item->status==3){?>
                                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['/appeal/viewresult','id'=>$item->id])?>"><span class="<?= $item->status0->icon?>"></span></a>
                                <?php }else{?>
                                    <span class="<?= $item->status0->icon?>"></span>
                                <?php }?>
                            </td>

                            <td><?= $item->bajaruvchi->company->name?></td>
                            <td><?= $item->number.'<br>'.$item->date ?></td>
                            <td><?= $item->preview?></td>
                            <td><?= $item->file? "<a href='/upload/{$item->file}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->name?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->status0->name ?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
