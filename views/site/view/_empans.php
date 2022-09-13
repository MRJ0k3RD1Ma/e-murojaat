<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Ҳодимлар томонидан келган жавоблар рўйхати
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
                        <th>Қисқача матни</th>
                        <th>Илова</th>
                        <th>Юборилган сана</th>
                        <th>Ҳолат</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $n=0; if(false){ foreach ($register->childempanswer as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td>
                                <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['/appeal/viewresult','id'=>$item->id])?>"><span class="<?= $item->status0->icon?>"></span></a>
                            </td>

                            <td><?= $item->user->name?></td>
                            <td><?= $item->preview?></td>
                            <td><?= $item->file? "<a href='/upload/{$item->file}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->status0->name ?></td>
                        </tr>
                    <?php endforeach;}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>