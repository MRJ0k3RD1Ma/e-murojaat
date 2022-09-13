<?= \yii\widgets\DetailView::widget([
    'model' =>$model,
    'attributes' => [
        'answer_number',
        'answer_date',
        'answer_preview',
        'answer_detail',
        'answer_name',
        [
            'attribute'=>'answer_file',
            'value'=>function($d){
                if($d->answer_file){
                    return "<a href='/upload/{$d->answer_file}'>Жавоб хатини юклаб олиш</a>";
                }else{
                    return null;
                }
            },
            'format'=>'raw'
        ],
        [
            'attribute'=>'answer_reply_send',
            'value'=>function($d){
                if($d->answer_reply_send == 0){
                    return "Мурожаатчига жавоб хати юборилган";
                }else{
                    return "Мурожаатчига жавоб хати юборилмаган";
                }
            }
        ],
        [
            'attribute'=>'status',
            'value'=>function($d){
                return $d->status0->name;
            }
        ],
    ],
]) ?>