<div class="row">
    <div class="col-md-6">

        <?= $this->render('view/_appeal',['model'=>$model])?>

    </div>
    <div class="col-md-6">

        <?= $this->render('view/_appealer',['model'=>$model])?>

    </div>
</div>

<?php if($model->status <2 and $model->type==1 and Yii::$app->user->identity->company_id==$model->company_id){?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Мурожаатни рўйхатга олиш
                    </h3>
                </div>
                <div class="card-body">
                    <?php $form = \yii\widgets\ActiveForm::begin()?>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($register, 'number')->textInput()?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($register, 'date')->textInput(['type'=>'date'])?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            $quest = [];
                            foreach (\app\models\AppealQuestionGroup::find()->all() as $item) {
                                $quest[$item->code.'-'.$item->name] = [];
                                foreach ($item->question as $i){
                                    $quest[$item->code.'-'.$item->name][$i->id] = $item->code.' '.$i->code.')'.$i->name;
                                }
                            }
                            ?>

                            <?= $form->field($register, 'question_id')->dropDownList($quest,['prompt'=>'Масаласини танланг','class'=>'form-control js-select2']) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($register,'rahbar_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['is_rahbar'=>1])->all(),'id','name'),['prompt'=>'Раҳбарни танланг'])?>

                        </div>
                        <div class="col-md-6">
                              <?= $form->field($register,'ijrochi_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all(),'id','name'),['prompt'=>'Ижрочини танланг'])?>

                        </div>


                        <div class="col-md-12">
                            <?= $form->field($register, 'preview')->textarea(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-success" type="submit">Сақлаш</button>
                        </div>

                    </div>
                    <?php \yii\widgets\ActiveForm::end()?>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<div class="row">
    <div class="col-md-12">

        <?php
            if($model->status == 4){
        ?>
                <?= $this->render('view/_close',['model'=>$model])?>

            <?php }else{?>
                <h4>Мурожаат кўриб чиқиш жараёнида</h4>
        <?php } ?>

    </div>
</div>