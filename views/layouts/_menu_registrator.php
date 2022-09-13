
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'notregister'
    )?'active':''?>">
        <i class="nav-icon fas fa-registered"></i>
        <p>
            Рўйхатга олинмаган
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'index'
        and Yii::$app->controller->action->id != 'request'
        and Yii::$app->controller->action->id != 'notregister'
    )?'active':''?>">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Мурожаатлар рўйхати
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/answered'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'answered'
    )?'active':''?>">
        <i class="nav-icon fas fa-check"></i>
        <p>
            Натижаси келган
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/tosayyor'])?>" class="nav-link
                    <?=(Yii::$app->controller->id=='appeal' and Yii::$app->controller->action->id == 'tosayyor')?'active':''?>">
        <i class="nav-icon fas fa-plus"></i>
        <p>
            Сайёр қабул
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/company/index'])?>" class="nav-link <?=(Yii::$app->controller->id=='company')?'active':''?>">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Ташкилотлар
        </p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-sync"></i>
        <p>
            Сўровлар
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'time'])?>" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Муддат узайтириш
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'reject'])?>" class="nav-link">
                <i class="nav-icon fas fa-random"></i>
                <p>
                    Ижрочини ўзгартириш
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'answered'])?>" class="nav-link">
                <i class="nav-icon fas fa-check"></i>
                <p>
                    Жавоби келган
                </p>
            </a>
        </li>

    </ul>
</li>

<?php if(Yii::$app->user->identity->is_village == 1){?>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/indexhok'])?>" class="nav-link <?=(Yii::$app->controller->id=='appeal' and Yii::$app->controller->action->id == 'indexhok')?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Вилоят ҳокимлигига юборилган
            </p>
        </a>
    </li>
<?php }?>