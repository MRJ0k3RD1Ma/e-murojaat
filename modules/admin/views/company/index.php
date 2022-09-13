<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ташкилотлар';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="company-index">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="" class="btn btn-danger" data-method="post"><span class="fa fa-file-excel"></span> Эхпорт</a>
                            <?= Html::a('Ташкилотни туман бўлимлари билан қўшиш', ['createwithdist'], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Ташкилот қўшиш', ['create'], ['class' => 'btn btn-success']) ?>

                            <button class="btn btn-info"><i class="fa fa-search"></i> Филтер</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//                            'name',
                                [
                                    'attribute'=>'name',
                                    'value'=>function($d){
                                        $url = Yii::$app->urlManager->createUrl(['/admin/company/view','id'=>$d->id]);
                                        return "<a href='{$url}'>{$d->name}</a>";
                                    },
                                    'format'=>'raw'
                                ],
                                'inn',
                                'director',
                                'phone',
                                'district_id',
                                [
                                    'attribute'=>'active_each',
                                    'value'=>function($d){
                                        $res = '';
                                        $t = 0;
                                        if($d->active_to){
                                            $res = $d->active_to;
                                            $t = 1;
                                        }
                                        if($d->active_each){
                                            if($t == 1){
                                                $res = $d->active_each .' гача';
                                            }else{
                                                $res .= ':'.$d->active_each .' гача';
                                            }
                                            $t = 2;
                                        }
                                        if($t > 0){
                                            return $res;
                                        }
                                        return "-";
                                    },
                                    'filter'=>false,
                                ],
                                [
                                    'attribute'=>'paid',
                                    'value'=>function($d){
                                        $txt = "";
                                        if($d->paid==0){
                                            $txt = "Тўланмаган";
                                        }else{
                                            $txt = $d->paid_date;
                                        }
                                        $url = Yii::$app->urlManager->createUrl(['/admin/company/paid','id'=>$d->id,'url'=>\yii\helpers\Url::current()]);
                                        return "<button value='{$url}' class='btn btn-link paidbtn'>{$txt}</button>";
                                    },
                                    'format'=>'raw'
                                ],
                                [
                                    'attribute'=>'parent_id',
                                    'value'=>function($d){
                                        if( $d->parent_id>0){
                                            return $d->parent->name;
                                        }else{
                                            return $d->parent;
                                        }
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

    <div class="modal" id="paidmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pul o'tirganligi haqidagi ma'lumotlari</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiqish</button>
                </div>
            </div>
        </div>
    </div>


<?php
$this->registerJs("
        $('.paidbtn').click(function(){
            var url = this.value;
            $('#paidmodal').modal('show').find('.modal-body').load(url);
        })
    ");
?>