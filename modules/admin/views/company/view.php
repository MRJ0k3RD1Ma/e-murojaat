<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <?= Html::a('Комплексга фойдаланувчи қўшиш', ['generatekomplex', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                        <?= Html::a('Фойдаланувчи қўшиш', ['adduser', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('ўзгартириш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h3>Ташкилот маълумотлари</h3>
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'inn',
//                            'password',
                                    'name',
                                    'director',
                                    'phone',
                                    'telegram',
                                    'active_to',
                                    'active_each',
                                    'created',
                                    'updated',
                                    'status',
                                    'management',
                                    'type_id',
                                    'group_id',
                                    'region_id',
                                    'district_id',
                                    'village_id',
                                    'address',
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-7">
                            <h3>Ташкилот фойдаланувчилари</h3>
                            <table id="example" style="width: 100%" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>ФИО</th>
                                        <th>Логин</th>
                                        <th>Бўлим</th>
                                        <th>Лавозим</th>
                                        <th>Телефон</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n=0;foreach ($model->user as $item): $n++;?>
                                        <tr>
                                            <td><?= $n?></td>
                                            <td><?= $item->name?></td>
                                            <td><?= $item->username?></td>
                                            <td><?= $item->bulim->name?></td>
                                            <td><?= $item->lavozim->name?></td>
                                            <td><?= $item->phone?></td>
                                            <td>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/admin/company/updateuser','id'=>$item->id])?>"><span class="fa fa-edit"></span></a>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/admin/company/deleteuser','id'=>$item->id,'com'=>$model->id])?>"><span class="fa fa-trash"></span></a>

                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>


<?php
$this->registerJs("
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
} );
")
?>