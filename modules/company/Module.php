<?php

namespace app\modules\company;

/**
 * company module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\company\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->viewPath = "@app/modules/company/views";
        \Yii::$app->set('company', [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Company',
            'enableAutoLogin' => true,
            'loginUrl' => ['company/default/login'],
        ]);

        // custom initialization code goes here
    }
}
