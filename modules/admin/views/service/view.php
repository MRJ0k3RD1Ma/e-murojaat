<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $searchModel app\models\search\ServiceLotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->name.' Lotlari ro`yhati';
$this->params['breadcrumbs'][] = ['label' => 'Xizmatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="service-view">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <p>
                        <?= Html::a('Yangi lot qo`shish', ['createlot', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                        <b style="font-size: 1.3em; float: right"><?= $model->name?>: <?= prettyNumber($model->price) ?> So'mdan. </b>
                        <span class="<?= $model->status == 1? 'bg-info' : 'bg-danger'?>" style="font-size: 1.3em; padding: 5px; float: right"><?= Yii::$app->params['service_status'][$model->status] ?></span>
                    </p>
                    <hr>
                    <h3>Mavjud lotlar</h3>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
//                            'lot_number',
                        [
                            'attribute'=>'lot_number',
                            'value'=>function($d){
                                $url = Yii::$app->urlManager->createUrl(['/admin/service/updatelot','id'=>$d->id]);
                                return "<a href='{$url}'>{$d->lot_number}</a>";
                            },
                            'format'=>'raw'
                        ],
                            'ads',
                            'exp_date',
                            [
                                'attribute'=>'status',
                                'value'=>function($d){
                                    if(date('Y-m-d',strtotime($d->exp_date))<date('Y-m-d')){
                                        return "Lot faol emas";
                                    }
                                    return "Lot faol";
                                }
                            ],

//                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>


                </div>
            </div>
        </div>
    </div>



</div>
