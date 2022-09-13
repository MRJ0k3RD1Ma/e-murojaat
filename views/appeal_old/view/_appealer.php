<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Мурожаатчи ҳақида
        </h3>
    </div>
    <div class="card-body">

        <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
//                        'id',
                'person_name',
                'person_phone',
                'date_of_birth',
//                        'gender',
                [
                    'attribute'=>'gender',
                    'value'=>function($d){
                        return Yii::$app->params['gender'][$d->gender];
                    }
                ],
                [
                    'attribute'=>'region_id',
                    'value'=>function($d){
                        return $d->region->name;
                    }
                ],
                [
                    'attribute'=>'district_id',
                    'value'=>function($d){
                        return $d->district->name;
                    }
                ],
                [
                    'attribute'=>'village_id',
                    'value'=>function($d){
                        return @$d->village->name;
                    }
                ],
                'address',
                'email',
                'businessman',
            ],
        ]) ?>


    </div>
</div>