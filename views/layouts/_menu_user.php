<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-filter"></i>
        <p>
            Менинг топшириқларим
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="/" class="nav-link <?=(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index')?'active':''?>">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Мурожаатлар рўйхати
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/companies'])?>" class="nav-link <?=(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='companies')?'active':''?>">
                <i class="nav-icon fas fa-route"></i>
                <p>
                    Ташкилотлар
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['#'])?>" class="nav-link <?=(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='answered')?'active':''?>">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                    Жавоби келган
                </p>
            </a>
        </li>

    </ul>
</li>


