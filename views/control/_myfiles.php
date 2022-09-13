<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model \app\models\AppealAnswer*/
/* @var $comment \app\models\AppealComment*/
/* @var $reg Integer*/
$sts = [0=>'Жавоб юбориш жараёнида',1=>'Тасдиқланиши кутилмоқда',2=>'Қабул қилинди',3=>'Рад этилди',4=>'Қайти кўриб чиқилсин'];
$sts_boshqa = [0=>'Жавоб юбориш жараёнида',1=>'Тасдиқланиши кутилмоқда', 2=>'Қабул қилинди',3=>'Рад этилди',4=>'Қайти кўриб чиқилсин'];
$bosh = 0;
if($reg != $model->register_id){
    $bosh = 1;
}
?>

<table class="table table-hover table-bordered">
    <tbody>
    <?php if($bosh == 0){?>
        <?php if($model->reaply_send == 1){?>
        <tr>
            <th colspan="2" class="bg-success">Мурожаатчига ушбу жавоб юборилган</th>
        </tr>
        <?php }?>
        <tr>
            <th><b>Ҳолат:</b></th>
            <td class="<?= getColor($model->status)?>"> <?= $sts[$model->status]?></td>
        </tr>
		<?php if($model->status != 1){?>
		<tr>
            <th><b>Ҳолат бўйича изоҳ:</b></th>
            <td><?= $comment->comment ?></td>
        </tr>
		<?php }?>
        <tr>
            <th><b>Файл:</b></th>
            <td>
                <?php if($model->file){?>
                <a href="<?= $model->file ? '/upload/'.$model->file : '#'?>">Файлни юклаб олиш</a>
                <?php }else{echo "Файл мавжуд эмас";}?>
            </td>
        </tr>
        <tr>
            <th><b>Изоҳ:</b></th>
            <td><?= $model->detail?></td>
        </tr>
        <?php
        $company = $model->bajaruvchi; ?>


        <tr>
            <th>Бажарувчи:</th>
            <td>

                <b></b> <?= $company->name;?>

            </td>
        </tr>

        <?php $regis = $model->register; if(($regis->ijrochi_id == Yii::$app->user->id or $regis->rahbar_id == Yii::$app->user->id) and $model->status == 1){?>

        <?php }}else{?>
            <?php if($model->reaply_send == 1){?>
                <tr>
                    <th colspan="2" class="bg-success">Мурожаатчига ушбу жавоб юборилган</th>
                </tr>
            <?php }?>
            <tr>
                <th><b>Ҳолат:</b></th>
                <td class="<?= getColor($model->status_boshqa)?>"> <?= $sts_boshqa[$model->status_boshqa]?></td>
            </tr>
            <tr>
                <th><b>Файл:</b></th>
                <td>
                    <?php if($model->file){?>
                        <a href="<?= $model->file ? '/upload/'.$model->file : '#'?>">Файлни юклаб олиш</a>
                    <?php }else{echo "Файл мавжуд эмас";}?>
                </td>
            </tr>
            <tr>
                <th>Ҳужжат номи:</th>
                <td><?= $model->preview?></td>
            </tr>
            <tr>
                <th><b>Изоҳ:</b></th>
                <td><?= $model->detail?></td>
            </tr>

            <tr>
                <th>Ҳужжат рақами ва санаси</th>
                <td>№<?= $model->number .', '.$model->date?></td>
            </tr>
            <tr>
                <th>Юборувчи ташкилот:</th>
                <td><?= $model->bajaruvchi->company->name ?></td>
            </tr>
            <tr>
                <th>Бажарувчи:</th>
                <td><?= $model->name ?></td>
            </tr>
            <tr>
                <th>Юборилган сана:</th>
                <td><?= $model->created?></td>
            </tr>


        <?php $regis = \app\models\AppealRegister::findOne($reg); if(($regis->ijrochi_id == Yii::$app->user->id or $regis->rahbar_id == Yii::$app->user->id) and $model->status_boshqa == 1){?>


        <?php }}?>
    </tbody>
</table>