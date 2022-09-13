<?php

namespace app\modules\rest\controllers;

use app\models\Appeal;
use app\models\Company;
use app\models\search\AppealRegisterClosedSearch;
use app\models\search\AppealRegisterDeadSearch;
use app\models\search\AppealRegisterRunningSearch;
use app\models\search\AppealRegisterSearch;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `rest` module
 */
class CompanyController extends ActiveController
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
    public $modelClass = Company::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new \app\models\search\CompanySearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
