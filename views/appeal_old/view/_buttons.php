<div class="dropdown" style="display: inline-block">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Топшириқ юбориш
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="collapse" href="#success">Ташкилотларга топшириқ бериш</a>
        <a class="dropdown-item" data-toggle="collapse" href="#taskemp">Ҳодимларга топшириқ бериш</a>
    </div>
</div>
<a href="#answer" class="btn btn-success" data-toggle="collapse">Жавоб юбориш</a>

<div class="dropdown" style="float: right; margin-left:5px;">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Маълумотларни янгилаш
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['/appeal/update','id'=>$register->id])?>">Резолюция</a>
        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['/appeal/updateappeal','id'=>$register->id])?>">Мурожаат маълумотлари</a>
        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['/appeal/updateregister','id'=>$register->id])?>">Ариза маълумотлари</a>
    </div>
</div>

<div class="dropdown" style="float: right">
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Сўров юбориш
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="collapse" href="#changetime">Муддатни узайтириш</a>
        <a class="dropdown-item" data-toggle="collapse" href="#reject">Бошқа давлат органига юбориш</a>
    </div>
</div>