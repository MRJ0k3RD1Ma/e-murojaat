<?php
/* @var $this yii\web\View */
/* @var $model app\models\Appeal */
/* @var $register app\models\AppealRegister */
/* @var $answer app\models\AppealAnswer */
/* @var $ans app\models\AppealAnswer */

use app\models\AppealAnswer;

$ans = AppealAnswer::find()->where(['register_id'=>$register->id])->andWhere(['bajaruvchi_id'=>Yii::$app->user->id])->orderBy(['id'=>SORT_DESC])->all();
?>
    <tr>
    <th colspan="4">Менинг жавобларим</th>
    </tr>
    <tr>
        <th></th>
        <th>Ҳолат</th>
        <th>файл</th>
        <th>Изоҳ</th>
    </tr>
    <?php
    $us = json_decode($register->users,true);
    $sts = [0=>'Тасдиқланиши кутилмоқда',1=>'Қабул қилинди',2=>'Рад этилди',3=>'Қайти кўриб чиқилсин'];
    foreach ($ans as $a): ?>
        <tr>
            <td>
                <button class="btn btn-primary myfiles" value="<?= Yii::$app->urlManager->createUrl(['/getappeal/myfiles','id'=>$a->id,'reg'=>$register->id])?>">
                    <span class="fa fa-eye"></span>
                </button>
            </td>
            <td class="<?= getColor($a->status-)?>"><?= $sts[$a->status-]?></td>
            <td><a href="<?= $a->file ? '/upload/'.$a->file : '#'?>">Юклаб олиш</a></td>
            <td><?php echo $a->detail; if($com = \app\models\AppealComment::find()->where(['answer_id'=>$a->id])->orderBy(['id'=>SORT_DESC])->one()){ echo "<br> <b>".$com->comment. "</b>";} ?></td>
        </tr>

    <?php endforeach; ?>

<?php if(count($ans)==0){?>
    <tr>
        <th colspan="4" class="bg-warning">Жавоб берилмаган</th>
    </tr>
<?php }?>
