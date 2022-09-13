

<?php if(Yii::$app->user->identity->is_control == 1){?>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/index'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and (Yii::$app->controller->action->id=='index' or Yii::$app->controller->action->id=='view'))?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Назорат
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/rahbar'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and (Yii::$app->controller->action->id=='rahbar' or Yii::$app->controller->action->id=='listrahbar' or Yii::$app->controller->action->id=='viewrahbar' ))?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Раҳбарлар
            </p>
        </a>
    </li>
<?php }?>


<?php if(Yii::$app->user->identity->is_control_district == 1){?>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/village'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and Yii::$app->controller->action->id=='village')?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Маҳалла кесимида
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/company'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and Yii::$app->controller->action->id=='company')?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Ташкилотлар кесимида
            </p>
        </a>
    </li>

<?php }?>




<?php if(Yii::$app->user->identity->is_control_system == 1){?>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/district'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and (Yii::$app->controller->action->id=='district' or Yii::$app->controller->action->id=='village'))?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Туманлар кесимида
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/control/companies'])?>" class="nav-link <?=(Yii::$app->controller->id=='control' and (Yii::$app->controller->action->id=='companies' or Yii::$app->controller->action->id=='company'))?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Ташкилотлар кесимида
            </p>
        </a>
    </li>
<?php }?>
