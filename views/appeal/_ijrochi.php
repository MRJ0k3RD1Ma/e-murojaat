<?php
/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */

use app\models\AppealAnswer;

$ans = AppealAnswer::find()->where(['appeal_id'=>$model->id])->orderBy(['id'=>SORT_DESC])->all();
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
$sts = [0=>'Жавоб юбориш жараёнида',1=>'Тасдиқланиши кутилмоқда',2=>'Қабул қилинди',3=>'Рад этилди',4=>'Қайти кўриб чиқилсин'];
$sts_boshqa = [0=>'Жавоб юбориш жараёнида',1=>'Тасдиқланиши кутилмоқда', 2=>'Қабул қилинди',3=>'Рад этилди',4=>'Қайти кўриб чиқилсин'];
foreach ($ans as $a):
    if($a->register_id != $register->id and $a->status_boshqa == 0){
        continue;
    }
    ?>
    <tr>
        <td>
            <button class="btn btn-primary myfiles" value="<?= Yii::$app->urlManager->createUrl(['/getappeal/myfiles','id'=>$a->id,'reg'=>$register->id])?>">
                <span class="fa fa-eye"></span>
            </button>
        </td>
        <?php if($a->register_id == $register->id){?>
        <td style="text-align: center;" class="<?= getColor($a->status)?>"><?= $sts[$a->status]?></td>
        <?php }else{?>
            <td style="text-align: center;" class="<?= getColor($a->status_boshqa)?>"><?= $sts[$a->status_boshqa]?></td>
        <?php }?>
        <td style="text-align: center"><?= $a->bajaruvchi->name?></td>
        <td><?php echo mb_substr($a->detail,0,100);?></td>
    </tr>
<?php endforeach; ?>

<?php if(count($ans)==0){?>
    <tr>
        <th colspan="4" class="bg-warning">Жавоб берилмаган</th>
    </tr>
<?php }?>
