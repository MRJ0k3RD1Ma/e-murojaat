<h3 class="card-title">
    Мурожаатнинг жавоби
</h3>
<?= \yii\widgets\DetailView::widget([
    'model' => \app\models\AppealAnswer::find()->where(['parent_id'=>$register->parent_bajaruvchi_id])->orderBy(['created'=>SORT_DESC])->one(),
    'attributes' => [
        'number',
        'date',
        'preview',
        'detail',
        'name',
//                                'file',
        [
            'attribute'=>'file',
            'value'=>function($d){
                if($d->file){
                    return "<a href='/upload/{$d->file}'>Жавоб хатини юклаб олиш</a>";
                }else{
                    return null;
                }
            },
            'format'=>'raw'
        ],
//                                'reaply_send',
        [
            'attribute'=>'reaply_send',
            'value'=>function($d){
                if($d->reaply_send == 0){
                    return "Мурожаатчига жавоб хати юборилган";
                }else{
                    return "Мурожаатчига жавоб хати юборилмаган";
                }
            }
        ],
//                                'status'
        [
            'attribute'=>'status',
            'value'=>function($d){
                return $d->status0->name;
            }
        ],
    ],
]) ?>