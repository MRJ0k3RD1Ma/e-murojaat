<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealBoshqaTashkilotGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ташкилот гуруҳлари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-boshqa-tashkilot-group-index">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <?= Html::a('Гуруҳ Қўшиш', ['create'], ['class' => 'btn btn-success']) ?>

                    </div>
                </div>
                <div class="card-body">

                                                                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                                    'id',
            'name',

                        ['class' => 'yii\grid\ActionColumn'],
                        ],
                        ]); ?>
                    
                                    </div>
            </div>
        </div>
    </div>



</div>
