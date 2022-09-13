<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompanyTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ташкилот турлари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-type-index">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <?= Html::a('Ташкилот тури қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name',
//                            'group_id',
                            [
                                'attribute'=>'group_id',
                                'value'=>function($d){
                                    return $d->group->name;
                                }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
