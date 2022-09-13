<?php
/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */
/* @var $ans app\models\AppealAnswer */

use app\models\AppealAnswer;

$ans = AppealAnswer::find()->where(['register_id'=>$register->id])->andWhere(['bajaruvchi_id'=>$register->ijrochi_id])->orderBy(['id'=>SORT_DESC])->all();
?>
<tr>
    <th colspan="4">Масъул ҳодим жавоблари:</th>
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
    if($register->parent_bajaruvchi_id != null and $register->rahbar_id == Yii::$app->user->id){
    ?>
    <tr>
        <td>
            <button class="btn btn-primary myfiles" value="<?= Yii::$app->urlManager->createUrl(['/getappeal/myfiles','id'=>$a->id,'reg'=>$register->id])?>">
                <span class="fa fa-eye"></span>
            </button>
            <?php if($a->status == 2 and false){?>
                <a class="btn btn-success" href="<?= Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$register->id,'ans'=>$a->id])?>"><span class="fa fa-reply"></span> </a>
            <?php }?>
        </td>
        <td class="<?= getColor($a->status_boshqa)?>"><?= $sts[$a->status_boshqa]?></td>
        <td><?= $register->ijrochi->name?></td>
        <td><?php echo $a->detail; ?></td>
    </tr>

    <?php }else{ ?>
        <tr>
            <td>
                <button class="btn btn-primary myfiles" value="<?= Yii::$app->urlManager->createUrl(['/getappeal/myfiles','id'=>$a->id,'reg'=>$register->id])?>">
                    <span class="fa fa-eye"></span>
                </button>
                <?php if($a->status == 2 and false){?>
                    <a class="btn btn-success" href="<?= Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$register->id,'ans'=>$a->id])?>"><span class="fa fa-reply"></span> </a>
                <?php } ?>
            </td>
            <td class="<?= getColor($a->status)?>"><?= $sts[$a->status]?></td>
            <td><?= $register->ijrochi->name?></td>
            <td><?php echo mb_substr($a->detail,0,100);?></td>
        </tr>
    <?php }?>
<?php endforeach; ?>

<?php if(count($ans)==0){?>
    <tr>
        <th colspan="4" class="bg-warning">Жавоб берилмаган</th>
    </tr>
<?php }?>

