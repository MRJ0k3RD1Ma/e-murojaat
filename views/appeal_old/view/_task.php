<div id="success" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #007bff;" data-parent="#accordion">

    <table class="table table-hover table-bordered datatable_tashkilot">
        <thead>
        <tr>
            <th></th>
            <th>Ташкилот номи</th>
            <th>Директор</th>
            <th>СТИР(ИНН)</th>
        </tr>
        </thead>
        <tbody>



        </tbody>
    </table>

</div>
<script>
    var taskemployee = function (){}
</script>
<div id="taskemp" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #007bff;" data-parent="#accordion">

    <table class="table table-hover table-bordered datatable_emp">
        <thead>
        <tr>
            <th>№</th>
            <th></th>
            <th>ФИО</th>
            <th>Лавозим</th>
            <th>Бўлим</th>
        </tr>
        </thead>
        <tbody>

        <?php $emp = \app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all();
        $n=0;
        foreach ($emp as $item): $n++;
            ?>
            <tr>
                <td><?= $n?></td>
                <td><button class="btn btn-primary" onclick="taskemployee('<?= Yii::$app->urlManager->createUrl(['/site/taskemp','id'=>$item->id,'regid'=>$register->id])?>')"><span class="fa fa-plus"></span></button></td>
                <td><?= $item->name?></td>
                <td><?= $item->lavozim->name?></td>
                <td><?= $item->bulim->name?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</div>