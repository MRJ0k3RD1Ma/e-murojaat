<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppealBajaruvchi;

/**
 * AppealBajaruvchiSearch represents the model behind the search form of `app\models\AppealBajaruvchi`.
 */
class AppealBajaruvchiComSearch extends AppealBajaruvchi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'appeal_id', 'register_id', 'deadline','status'], 'integer'],
            [['deadtime', 'created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AppealBajaruvchi::find()
        ->innerJoin('appeal_register','appeal_register.id=appeal_bajaruvchi.register_id')
            ->andWhere(['appeal_register.company_id'=>\Yii::$app->user->identity->company_id])
            ->andWhere(['appeal_bajaruvchi.company_id'=>$_GET['id']])
            ->orderBy(['appeal_register.created'=>SORT_DESC])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'company_id' => $this->company_id,
            'appeal_id' => $this->appeal_id,
            'register_id' => $this->register_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
        ]);

        return $dataProvider;
    }
}
