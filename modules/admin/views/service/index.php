<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xizmatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <?= Html::a('Xizmat qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//                            'name',
                            [
                                'attribute'=>'name',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/admin/service/view','id'=>$d->id]);
                                    return "<a href='{$url}'>{$d->name}</a>";
                                },
                                'format'=>'raw'
                            ],
                            'price',
                            [
                                'attribute'=>'status',
                                'value'=>function($d){
                                    return Yii::$app->params['service_status'][$d->status];
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
