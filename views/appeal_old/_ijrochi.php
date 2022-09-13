<?php
/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */

use app\models\AppealAnswer;

$ans = AppealAnswer::find()->where(['register_id'=>$register->id])->orderBy(['id'=>SORT_DESC])->all();
?>
<tr>
    <th colspan="4">Жавоблар рўйхати</th>
</tr>
<tr>
    <th></th>
    <th>Ҳолат</th>
    <th>ФИО</th>
    <th>Изоҳ</th>
</tr>
<?php
$us = json_decode($register->users,true);
$sts = [0=>'Тасдиқланиши кутилмоқда',1=>'Қабул қилинди',2=>'Рад этилди'];
$sts_boshqa = [0=>'Жавоб юбориш жараёнида',1=>'Тасдиқланиши кутилмоқда', 2=>'Қабул қилинди',3=>'Рад этилди',4=>'Қайти кўриб чиқилсин'];

foreach ($ans as $a): ?>
    <tr>
        <td>
            <button class="btn btn-primary myfiles" value="<?= Yii::$app->urlManager->createUrl(['/getappeal/myfiles','id'=>$a->id,'reg'=>$register->id])?>">
                <span class="fa fa-eye"></span>
            </button>
        </td>
        <?php if($register->parent_bajaruvchi_id != null){?>
             <td style="text-align: center;" class="<?= getBoshqaColor($a->status_boshqa)?>"><?= $sts_boshqa[$a->status_boshqa]?></td>
        <?php }else{?>
            <td style="text-align: center;" class="<?= getColor($a->status-1)?>"><?= $sts[$a->status-1]?></td>

        <?php }?>
        <td style="text-align: center"><?= $a->bajaruvchi->name?></td>
        <td><?php echo $a->detail; if($com = \app\models\AppealComment::find()->where(['answer_id'=>$a->id])->orderBy(['id'=>SORT_DESC])->one()){ echo "<br> <b>".$com->comment. "</b>";} ?></td>
    </tr>
<?php endforeach; ?>

<?php if(count($ans)==0){?>
    <tr>
        <th colspan="4" class="bg-warning">Жавоб берилмаган</th>
    </tr>
<?php }?>
