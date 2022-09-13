<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Муожаат маълумотлари
        </h3>
    </div>
    <div class="card-body">


        <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
//                        'id',
                'id',
                'number_full',
                'appeal_detail',
//                        'appeal_file',
                [
                    'attribute'=>'appeal_file',
                    'value'=>function($d){
                        if($d->appeal_file){
                            return "<a href='/upload/{$d->appeal_file}'>Иловани юклаб олиш</a>";
                        }else{
                            return null;
                        }
                    },
                    'format'=>'raw'
                ],
//                        'deadtime',

                'updated',
//                        'boshqa_tashkilot',
                [
                    'attribute'=>'question_id',
                    'value'=>function($d){
                        if($d->question_id){
                            $q = $d->question;
                            return $q->group->code.'-'.$q->code.'.'.$q->name;
                        }
                        return null;
                    },
                ],
                [
                    'attribute'=>'appeal_shakl_id',
                    'value'=>function($d){
                        return $d->appealShakl->name;
                    },
                ],
                [
                    'attribute'=>'appeal_type_id',
                    'value'=>function($d){
                        return $d->appealType->name;
                    },
                ],
                [
                    'label'=>'Қабул қилган ташкилот',
                    'attribute'=>'boshqa_tashkilot',
                    'value'=>function($d){
                        if($d->boshqa_tashkilot){
                            return $d->boshqaTashkilot->name.'<br>'.$d->boshqa_tashkilot_number.' '.$d->boshqa_tashkilot_date;
                        }else{
                            return "Бевосита";
                        }
                    }
                ],
                [
                    'attribute'=>'company_id',
                    'value'=>function($d){
                        return $d->company->name;
                    },
                ],

            ],
        ]) ?>

    </div>
</div>

