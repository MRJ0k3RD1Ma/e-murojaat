<h3 class="card-title">
    Ариза маълумотлари
</h3>
<?= \yii\widgets\DetailView::widget([
    'model' => $register,
    'attributes' => [
        'id',
        'number',
        'date',
        [
            'label'=>'Юборувчи ташкилот',
            'attribute'=>'parent_bajaruvchi_id',
            'value'=>function($d){
                if($d->parent_bajaruvchi_id){
                    $res = $d->parent->register;
                    return $res->company->name.'<br>'.$res->number.'<br>'.$res->date;
                }else{
                    return 'Бевосита';
                }
            },
            'format'=>'raw'
        ],
        [
            'attribute'=>'deadtime',
            'value'=>function($d){
                return $d->deadline.' кун '.$d->deadtime;
            }
        ],
        'donetime',
        [
            'attribute'=>'control_id',
            'value'=>function($d){
                return $d->control->name;
            }
        ],
        'preview',

        [
            'attribute'=>'nazorat',
            'value'=>function($d){
                return Yii::$app->params['nazorat'][$d->nazorat];
            }
        ],
        [
            'attribute'=>'rahbar_id',
            'value'=>function($d){
                return @$d->rahbar->name;
            }
        ],
        [
            'attribute'=>'ijrochi_id',
            'value'=>function($d){
                return @$d->ijrochi->name;
            }
        ],
    ],
]) ?>