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
                if($d->status == 4){
                    return "<span class='bg-success' style='display: block;text-align: center'>Бажарилган</span>".
                        $d->donetime;
                }
                $datetime2 = date_create($d->deadtime);
                $datetime1 = date_create(date('Y-m-d'));
                $interval = date_diff($datetime1, $datetime2);
                $days = $interval->format('%a ');
                $ds = $interval->format('%R%a ');
                $d->deadtime = date('d-m-Y',strtotime($d->deadtime));
                $class = "";
                if($ds <= 5){
                    $class = "bg-warning";
                }
                if($ds < 0){
                    $class = "bg-danger";
                }
                $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;text-align: center'>".$days.' кун<br>'.$d->deadtime."</span> ";


                if($ds < 0){
                    $class = "bg-danger";
                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>Муддати ўтган</span>";
                }elseif($ds <= 5){
                    $class = "bg-warning";
                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";
                }else{$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";}

                return $res;
            },
            'format'=>'raw'
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