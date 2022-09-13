<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Менинг юборган сўровларим
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
                        <th>Тури</th>
                        <th>Батафсил</th>
                        <th>Илова</th>
                        <th>Қабул қилувчи</th>
                        <th>Ҳолат</th>
                        <th>Юборилган сана</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $n=0; foreach ($register->myrequest as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td>
                                 <span class="<?= $item->status->icon?>"></span>
                            </td>

                            <td><?= $item->type->name?></td>
                            <td><?= $item->detail?></td>
                            <td><?= $item->file? "<a href='/upload/{$item->file}' download>Иловани юклаб олинг</a>" : 'Илова мавжуд эмас'?></td>
                            <td><?= $item->reciever->company->name ?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->status->name ?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>