<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AppealQuestionGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appeal Question Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-group-index">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <?= Html::a('Қўшиш Appeal Question Group', ['create'], ['class' => 'btn btn-success']) ?>

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
            'code',
            'name',

                        ['class' => 'yii\grid\ActionColumn'],
                        ],
                        ]); ?>
                    
                                    </div>
            </div>
        </div>
    </div>



</div>
