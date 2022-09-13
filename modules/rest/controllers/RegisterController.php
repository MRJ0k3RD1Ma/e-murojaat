<?php

namespace app\modules\rest\controllers;

use app\models\AppealRegister;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `rest` module
 */
class RegisterController extends ActiveController
{
    public function behaviors()
    {
        return [
            [
                'class' => \yii\ filters\ ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => \yii\ web\ Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    public $enableCsrfValidation = false;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public $modelClass = AppealRegister::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new \app\models\search\AppealRegisterFullSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }

}
